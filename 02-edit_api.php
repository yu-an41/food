<?php require __DIR__ . '/parts/connect_db.php';
header('Content-Type: application/json');
//要輸出的陣列，先定義值等於字串或數值

$folder = __DIR__ . '/uploads/';

$fileExt = [
    'image/jpg' => '.jpg',
    'image/png' => '.png',
    'image/jpeg' => '.jpeg'
];

$output = [
    'success' => false,
    'error' => '',
    'code' => 0,
    'file' => $_FILES,
    'postData' => $_POST, // 除錯用的,回傳輸出出去的資料查看

];

if (empty($_FILES['img']['name'])) {
    $sql = "UPDATE `official_post` SET
    `title`=?, 
     `content`=?, 
     `hashtag`=? 
     WHERE sid=?";

    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([
            $_POST['title'],
            $_POST['content'],
            $_POST['hashtag'],
            $_POST['sid']
        ]);
    } catch (PDOException $ex) {
        $output['error'] = $ex->getMessage();
    }
} else {

    //副檔名對應
    $ext = $fileExt[$_FILES['img']['type']];

    if (empty($ext)) {
        $sql = "UPDATE `official_post` SET
    `title`=?, 
    `content`=?, 
    `hashtag`=? 
     WHERE sid=?";
        $output['error'] = '檔案格式錯誤:要jpeg, png';
        echo json_encode($output, JSON_UNESCAPED_UNICODE);

        $stmt = $pdo->prepare($sql);
        try {
            $stmt->execute([
                $_POST['title'],
                $_POST['content'],
                $_POST['hashtag'],
                $_POST['sid']
            ]);
        } catch (PDOException $ex) {
            $output['error'] = $ex->getMessage();
        }
    } else {
        $filename = md5($_FILES['img']['name'] . uniqid()) . $ext;
        //隨機檔名

        if (!move_uploaded_file(
            $_FILES['img']['tmp_name'],
            $folder . $filename
        )) {
            $output['error'] = '無法移動上傳檔案,注意資料夾權限問題';
            echo json_encode($output, JSON_UNESCAPED_UNICODE);
            exit;
        }

        //必填資料設定
        if (empty($_POST['title'])) {
            $output['error'] = '參數不足';
            $output['code'] = 400;
            echo json_encode($output, JSON_UNESCAPED_UNICODE);
            exit;
        }

        $sql = "UPDATE `official_post` SET
    `title`=?,
     `img`=?, 
     `content`=?, 
     `hashtag`=? 
     WHERE sid=?";

        $stmt = $pdo->prepare($sql);

        // $hashtag = null;
        // if (strtotime($_POST['hashtag']) !== false) {
        //     $hashtag = $_POST['hashtag'];
        // }

        try {
            $stmt->execute([
                $_POST['title'],
                $filename,
                $_POST['content'],
                $_POST['hashtag'],
                $_POST['sid']
            ]);
        } catch (PDOException $ex) {
            $output['error'] = $ex->getMessage();
        }
    }
}



if ($stmt->rowCount()) {
    $output['success'] = true;
} else {
    if (empty($output['error']))
        $output['error'] = '資料沒有修改';
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
