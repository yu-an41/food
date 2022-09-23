<?php
include __DIR__ . '/parts/connect_db.php';
$pageName = 'orderHistory';

$sql = "SELECT * FROM `order-history`";

$stmt = $pdo->prepare($sql)->fetchAll();
$rows = [];

if ($totalRows > 0) {
    if ($page < 1) {
        header('Location: ?page = 1');
        exit;
    }
    if ($page > $totalPages) {
        header('Location: ?page=' . $totalPages);
        exit;
    }
    $sql = sprintf("SELECT * FROM `product-list` ORDER BY `product_sid` LIMIT %s, %s", ($page - 1) * $perPage, $perPage);

    $rows = $pdo->query($sql)->fetchAll();
}

?>
<?php
include __DIR__ . '/parts/html-head.php'; ?>
<?php
include __DIR__ . '/parts/nav-bar-admin.php'; ?>
<div class="container">
    <div class="row">
        <h4 class="text-center mb-3">歷史訂單一覽</h4>
        <div class="col">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">
                            <i class="fa-solid fa-trash"></i>
                        </th>
                        <th scope="col">order_sid</th>
                        <th scope="col">order_num</th>
                        <th scope="col">member_sid</th>
                        <th scope="col">created_at</th>
                        <th scope="col">total</th>
                        <th scope="col">order_status</th>
                        <th scope="col">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $r) : ?>
                        <tr>
                            <td>
                                <a href="javascript: delete_it(<?= $r['order_sid'] ?>)">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                            <td><?= $r['order_sid'] ?></td>
                            <td><?= $r['order_num'] ?></td>
                            <td><?= $r['member_sid'] ?></td>
                            <td><?= $r['created_at'] ?></td>
                            <td><?= $r['total'] ?></td>
                            <td><?= $r['order_status'] ?></td>
                            <td>
                                <a href="#">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
include __DIR__ . '/parts/scripts.php'; ?>
<script>
    const table = document.querySelector('table');

    function delete_it(order_sid) {
        if (confirm(`確定要刪除編號為 ${order_sid} 的訂單資料嗎?`)) {
            location.href = `delete.php?sid= ${order_sid}`;
        }
    }
</script>
<?php
include __DIR__ . '/parts/html-foot.php'; ?>