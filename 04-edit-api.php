<?php
require __DIR__ . '/parts/user-required.php';
require __DIR__ . '/parts/connect_db.php';

header('Content-Type: application/json');

$folder = __DIR__ . '/img/'; //上傳檔案的資料夾

$output = [
    'success' => false,
    'error' => '',
    'code' => 0,
    'data' => [],
    'file' => $_FILES['picture']['name'], 
    'postData' => $_POST // 除錯用的
];

if (empty($_FILES['picture']['name'])) {
    $sql = "UPDATE `food_product` SET 
    `product_categories_sid`=?,
    `product_name`=?,
    `product_description`=?,
    `unit_price`=?,
    `sale_price`=?,
    `product_launch`=?
    WHERE sid =?";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([
            $_POST['product_categories'],
            $_POST['product_name'],
            $_POST['product_description'],
            $_POST['unit_price'],
            $_POST['sale_price'],
            $_POST['product_launch'],
            $_POST['sid1']
        ]);
    } catch (PDOException $ex) {
        $output['error'] = $ex->getMessage();
    }
} else {

    $extMap = [
        'image/jpeg' => '.jpg',
        'image/png' => '.png',
    ];

    $ext = $extMap[$_FILES['picture']['type']];

    if (empty($ext)) {
        $output['error'] = '檔案格式錯誤: 要 jpeg, png';
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
        exit;
    }

    $filename = md5($_FILES['picture']['name'] . uniqid()) . $ext;
    $output['filename'] = $filename;

    if (!move_uploaded_file(
        $_FILES['picture']['tmp_name'],
        $folder . $filename
    )) {
        $output['error'] = '無法移動上傳檔案, 注意資料夾權限問題';
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
        exit;
    }

$sql = "UPDATE `food_product` SET 
    `product_picture`=?,
    `product_categories_sid`=?,
    `product_name`=?,
    `product_description`=?,
    `unit_price`=?,
    `sale_price`=?,
    `product_launch`=?
    WHERE sid=?";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([
            $filename,
            $_POST['product_categories'],
            $_POST['product_name'],
            $_POST['product_description'],
            $_POST['unit_price'],
            $_POST['sale_price'],
            $_POST['product_launch'],
            $_POST['sid1']
        ]);
    } catch (PDOException $ex) {
        $output['error'] = $ex->getMessage();
    }
}

if ($stmt->rowCount()) {
    $output['success'] = true;
} else {
    if (empty($output['error']))
        $output['error'] = '資料沒有修改';
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
