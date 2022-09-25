<?php
require __DIR__ . '/parts/connect_db.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$sid = isset($_POST['sid']) ? intval($_POST['sid']) : 0;
$qty = isset($_POST['qty']) ? intval($_POST['qty']) : 0;


if (!empty($sid)) {

    if (!empty($qty)) {

        if (!empty($_SESSION['cart'][$sid])) {
            $_SESSION['cart'][$sid]['qty'] += $qty;
        } else {
            $sql = "SELECT * FROM `product-list` WHERE `product_sid`= $sid";
            $row = $pdo->query($sql)->fetch();

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
