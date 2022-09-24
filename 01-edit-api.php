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

if (empty($_POST['oderStatus'])) {
    $output['error'] = '未選擇訂單狀態';
    $output['code'] = 400;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$sql = "UPDATE `order_history` SET `order_status` = ? WHERE `order_sid` = ?";

$stmt = $pdo->prepare($sql);

$od = '已付款';
if ((!$_POST['order_status'] == '已付款') or (!$_POST['order_status'] == '已取貨') or (!$_POST['order_status'] == '退款申請中') or (!$_POST['order_status'] == '已退款')) {
    $od = $_POST['order_status'];
}

try {
    $stmt->execute([
        $_POST['order_sid'],
        $od,
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
