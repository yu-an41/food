<?php 
require __DIR__ . '/parts/admin-required.php';
require __DIR__ . '/parts/connect_db.php'; 

$order_num = isset($_GET['order_num'])? intval($_GET['order_num']): 0;

$sql = "DELETE FROM `order_history` WHERE `order_num` = ${order_num}";

$pdo ->query($sql);

$come_from = '01-order-history-admin.php';

if(! empty($_SERVER['HTTP_REFERER'])) {
    $come_from = $_SERVER['HTTP_REFERE'];
}
header("Location: {$come_from}");