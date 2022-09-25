<?php include __DIR__ . '/parts/connect_db.php';
header('Content-Type: application/json');

$folder = __DIR__ . '/uploads/';

$extMap = [
    'image/jpeg' => '.jpg',
    'image/png' => '.png'
];

$output = [
    'success' => false,
    'error' => '',
    'code' => 0,
    'file' => $_FILES,
    'postdata' => $_POST
];

//副檔名對應
$ext = $extMap[$_FILES['images']['type']];
if(empty($ext)){
    $output['error'] = '檔案格式錯誤:要jpeg, png';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

//隨機檔名
$filename = md5($_FILES['images']['name'] . uniqid()) . $ext;

if (!move_uploaded_file(
    $_FILES['images']['tmp_name'],
    $folder . $filename
)) {
    $output['error'] = '無法移動上傳檔案,注意資料夾權限問題';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

if (empty($_POST['name'])) {
    $output['error'] = '參數不足';
    $output['code'] = '400';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

//檢查欄位資料
$sql = "INSERT INTO `event_test_1`(
    `images`,`name`, `content`, `location`, `tags`,  
    `date`,`restricted_maximum`, `host`, `price`, 
    `created_at`) VALUES (
    ?,?, ?, ?, ?, 
    ?, ?, ?, ?,
    NOW() )";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    $filename,
    $_POST['name'],
    $_POST['content'],
    $_POST['location'],
    $_POST['tags'],
    $_POST['date'],
    $_POST['restricted_maximum'],
    $_POST['host'],
    $_POST['price']
]);

if ($stmt->rowCount()) {
    $output['success'] = true;
} else {
    $output['error'] = '資料沒有新增';
}


echo json_encode($output, JSON_UNESCAPED_UNICODE);
