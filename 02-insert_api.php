<?php require __DIR__ . '/parts/connect_db.php';
header('Content-Type: application/json');
//要輸出的陣列，先定義值等於字串或數值

$folder = __DIR__ . '/uploads/';

$fileExt = [
    'image/jpeg' => '.jpeg',
    'image/png' => '.png'
];

$output = [
    'success' => false,
    'error' => '',
    'code' => 0,
    'file' => $_FILES,
    'postData' => $_POST, // 除錯用的,回傳輸出出去的資料查看
];
//副檔名對應
$ext = $fileExt[$_FILES['img']['type']];
if (empty($ext)) {
    $output['error'] = '檔案格式錯誤:要jpeg, png';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

//隨機檔名
$filename = md5($_FILES['img']['name'] . uniqid()) . $ext;

if (!move_uploaded_file(
    $_FILES['img']['tmp_name'],
    $folder . $filename
)) {
    $output['error'] = '無法移動上傳檔案,注意資料夾權限問題';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
};


//必填資料設定
if (empty($_POST['title'])) {
    $output['error'] = '參數不足';
    $output['code'] = 400;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}
//後端檢查資料欄位
$sql = "INSERT INTO `official_post`(`title`, `img`, `content`, `hashtag`, `created_at`) VALUES (?,?,?,?,NOW())";

$stmt = $pdo->prepare($sql);

// $stmt->execute([
//     $_POST['title'],
//     $filename,
//     $_POST['content'],
//     $_POST['hashtag'],

// ]);
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
    ]);
} catch (PDOException $ex) {
    $output['error'] = $ex->getMessage();
}

if ($stmt->rowCount()) {
    $output['success'] = true;
} else {
    if (empty($output['error']))
        $output['error'] = '資料新增失敗';
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
