<?php
require __DIR__ . '/parts/connect_db.php';

header('Content-Type: application/json');

$output = [
    'success' => false,
    'error' => '',
    'code' => 0,
    'data' => [],
    'file' => $_FILES, //除錯用
    'postData' => $_POST // 除錯用的
];

if (empty($_POST['shop_email'])) {
    $output['error'] = '參數不足';
    $output['code'] = 400;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$folder = __DIR__ . '/uploads/'; //上傳檔案的資料夾

$extMap = [
    'image/jpeg' => '.jpg',
    'image/png' => '.png',
];

if(empty($_FILES['shop_cover'])){
    $output['error'] = '沒有上傳檔案';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$ext = $extMap[$_FILES['shop_cover']['type']];
if(empty($ext)){
    $output['error'] = '檔案格式錯誤: 要 jpeg, png';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$filename = md5($_FILES['shop_cover']['name'] . uniqid()). $ext;
$output['filename'] = $filename;

if (!move_uploaded_file(
    $_FILES['shop_cover']['tmp_name'],
    $folder . $filename
)) {
    $output['error'] = '無法移動上傳檔案,注意資料夾權限問題';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$sql = "INSERT INTO `shop_list`(
    `shop_cover`,`shop_email`, `shop_password`, `shop_name`, `shop_phone`, `shop_address_city`,`shop_address_area`,`shop_address_detail`,`shop_opentime`,`shop_closetime`,`shop_deadline`,`shop_approved`,`shop_created_at`
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

$stmt = $pdo->prepare($sql);

try {
    $stmt->execute([
        $filename,
        $_POST['shop_email'],
        password_hash($_POST['shop_password'],PASSWORD_DEFAULT),
        $_POST['shop_name'],
        $_POST['shop_phone'],
        $_POST['shop_address_city'],
        $_POST['shop_address_area'],
        $_POST['shop_address_detail'],
        $_POST['shop_opentime'],
        $_POST['shop_closetime'],
        $_POST['shop_deadline'],
        $_POST['shop_approved'],
    ]);
} catch (PDOException $ex) {
    $output['error'] = $ex->getMessage();
}

if ($stmt->rowCount()) {
    $output['success'] = true;
} else {
    if (empty($output['error']))
        $output['error'] = '資料沒有新增';
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
