<?php
require __DIR__ . '/parts/connect_db.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
$qty = isset($_GET['qty']) ? intval($_GET['qty']) : 0;

if (!empty($sid)) {

    if (!empty($qty)) {

        if (!empty($_SESSION['cart'][$sid])) {
            $_SESSION['cart'][$sid]['qty'] = $qty;
        } else {
            $row = $pdo->query("SELECT * FROM `product-list` WHERE `sid` = $sid")->fetch();

            if (!empty($row)) {
                $row['qty'] = $qty;
                $_SESSION['cart'][$sid] = $row;
            }
        }
    } else {
        unset($_SESSION['cart'][$sid]);
    }
}

echo json_encode($_SESSION['cart']);
