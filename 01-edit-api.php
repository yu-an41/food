<?php
require __DIR__ . '/parts/admin-required.php';
require __DIR__ . '/parts/connect_db.php';

header('Content-Type: applcation/json');

$output = [
    'success' => false,
    'error' => '',
    'code' => 0,
    'postData' => $_POST,
];

if (empty($_POST['orderStatus'])) {
    $output['error'] = '未選擇訂單狀態';
    $output['code'] = 400;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$sql = "UPDATE `order-history` SET `order_status` = ? WHERE `order_sid` = ?";

$stmt = $pdo->prepare($sql);

try {
    $stmt->execute([
        $_POST['orderStatus'],
        $_POST['orderSid'],
    ]);
} catch (PDOException $ex) {
    $output['error'] = $ex->getMessage();
}

if ($stmt->rowCount()) {
    $output['success'] = true;
} else {
    if (empty($output['error']))
        $output['error'] = '訂單狀態沒有修改';
}
echo json_encode($output, JSON_UNESCAPED_UNICODE);
