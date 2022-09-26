<?php require __DIR__ . '/parts/connect_db.php';
header('Content-Type: application/json');



$output = [
    'success' => false,
    'error' => '',
    'code' => 0,
    'file' => $_FILES,
    'postData' => $_POST, // 除錯用的,回傳輸出出去的資料查看
];

//必填資料設定
if (empty($_POST['content'])) {
    $output['error'] = '參數不足';
    $output['code'] = 400;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}
//後端檢查資料欄位
$sql = "INSERT INTO `comment`(
    `member_sid`,
    `categories_sid`,
    `post_sid`,
    `content`,
    `parent_sid`,
    `created_at`) 
    VALUES ('1','2','3','?','0',NOW());";

$stmt = $pdo->prepare($sql);


try {
    $stmt->execute([
        $_POST['member_sid'],
        $_POST['categories_sid'],
        $_POST['post_sid'],
        $_POST['content'],
        $_POST['parent_sid']
    ]);
} catch (PDOException $ex) {
    $output['error'] = $ex->getMessage();
}

if ($stmt->rowCount()) {
    $output['success'] = true;
} else {
    if (empty($output['error']))
        $output['error'] = '留言失敗';
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
