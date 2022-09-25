<?php
require __DIR__ . '/parts/admin-required.php';
require __DIR__ . '/parts/connect_db.php';

$order_num = isset($_GET['order_num']) ? intval($_GET['order_num']) : 0;

$sql =
    "DELETE FROM `order-history` WHERE `order_num` = ${order_num};
    DELETE FROM `order-details` WHERE `order_num` = ${order_num}";

$pdo->query($sql);

$come_from = '01-order-details-admin.php';

if (!empty($_SERVER['HTTP_REFERER'])) {
    $come_from = $_SERVER['HTTP_REFERER'];
}
header("Location: {$come_from}");
