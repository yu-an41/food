<?php
require __DIR__ . '/parts/admin-required.php';
require __DIR__ . '/parts/connect_db.php';

header('Content-Type: application/json');

$output = [
    'success' => false,
    'error' => '',
    'code' => 0,
    'postData' => $_POST, // 除錯用的
];

if (empty($_FILES['picture']['name'])) {
    $sql = "UPDATE `food_product` SET 
    `product_categories_sid`=?,
    `product_name`=?,
    `product_description`=?,
    `unit_price`=?,
    `sale_price`=?
    WHERE sid =?";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([
            $_POST['product_categories'],
            $_POST['product_name'],
            $_POST['product_description'],
            $_POST['unit_price'],
            $_POST['sale_price'],
            $_POST['sid1']
        ]);
    } catch (PDOException $ex) {
        $output['error'] = $ex->getMessage();
    }

} else {
    $sql = "UPDATE `food_product` SET 
    `product_picture`=?,
    `product_categories_sid`=?,
    `product_name`=?,
    `product_description`=?,
    `unit_price`=?,
    `sale_price`=?
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
        $output['error']='資料沒有修改';
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
