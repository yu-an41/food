<?php
require __DIR__ . '/parts/connect_db.php';

if (empty($_SESSION['user']) or empty($_SESSION['cart'])) {
    header('Location: product-list');
    exit;
}

$total = 0;
foreach ($_SESSION['cart'] as $k => $v) {
    $total += $v['price'] * $v['qty'];
}

$o_sql = sprintf("INSERT INTO `order-history`(`created_at`, `total`, `member_sid`) VALUES (NOW(),? ,?",);

$stmt = $pdo->query($o_sql);

// echo json_encode([
//     'rowCount' => $stmt->rowCount(),
//     'lastInsertId' => $pdo->lastInsertId(),
// ]);
// exit;

$od_sql = sprintf("INSERT INTO `order-details`(`order_sid`, `created_at`, `product_sid`, `product_name`, `quantity`, `total_price`) VALUES (?, NOW(), ?, ?, ?, ?");
$stmt = $pdo->prepare($od_sql);

foreach ($_SESSION['cart'] as $k => $v) {
    $stmt->execute([
        $order_sid,
        $v['sid'],
        $v['price'],
        $v['qty'],
    ]);
}

unset($_SESSION['cart']);

?>
<?php include __DIR__ . '/parts/html-head.php'; ?>
<?php include __DIR__ . '/parts/nav-bar-no-admin.php'; ?>
<div class="container">
    <h2>感謝購買</h2>
</div>
<?php include __DIR__ . '/parts/scripts.php'; ?>
<?php include __DIR__ . '/parts/html-foot.php'; ?>