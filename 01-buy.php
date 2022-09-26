<?php
require __DIR__ . '/parts/connect_db.php';

// if (empty($_SESSION['member']) or empty($_SESSION['cart'])) {
//     header('Location: 01-product-list-cart.php');
//     exit;
// }

$total = 0;
foreach ($_SESSION['cart'] as $k => $v) {
    $total += $v['product_price'] * $v['qty'];
}

//抓當前時間
$date = new DateTime();
//轉換格式
$date = explode("/", date('Y/m/d/h/i/s'));
//時間轉換字串陣列
list($Y, $M, $D, $H, $I, $S) = $date;
//陣列透過PHP的implode()變成一個字串
$order_num = implode('', $date);

$member_sid = 401; // 先給一個假的member_sid
$o_sql = "INSERT INTO `order-history`(`created_at`, `total`, `member_sid`, `order_num`) 
    VALUES (NOW(),$total ,$member_sid , $order_num)";

$stmt = $pdo->query($o_sql);

// echo json_encode([
//     'rowCount' => $stmt->rowCount(),
//     'lastInsertId' => $pdo->lastInsertId(),
// ]);
// exit;


$od_sql = sprintf(
    "INSERT INTO `order-details`(`order_num`, `created_at`, `product_sid`, `product_name`, `quantity`, `total_price`) 
    VALUES (?, NOW(), ?, ?, ?, ?)"
);
$stmt = $pdo->prepare($od_sql);

foreach ($_SESSION['cart'] as $k => $v) {
    $stmt->execute([
        $order_num,
        $v['product_sid'],
        $v['product_name'],
        $v['qty'],
        $v['product_price'] * $v['qty']
    ]);
}

unset($_SESSION['cart']);

?>
<?php include __DIR__ . '/parts/html-head.php'; ?>
<?php include __DIR__ . '/parts/nav-bar-no-admin.php'; ?>
<?php include __DIR__ . '/parts/scripts.php'; ?>
<script>
    alert('感謝購買');
    setTimeout(
        location.href = '01-product-list-cart.php', 1000);
</script>
<?php include __DIR__ . '/parts/html-foot.php'; ?>