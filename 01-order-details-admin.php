<?php
require __DIR__ . '/parts/connect_db.php';
$pageName = 'orderDetails';

$perPage = 5;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$od_sql = "SELECT count(1) FROM `order-details`";
$totalRows = $pdo->query($od_sql)->fetch(PDO::FETCH_NUM)[0];

$totalPages = ceil($totalRows / $perPage);
if ($page < 1) {
    $page = 1;
}
if ($page > $totalPages) {
    $page = $totalPages;
}

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
    $sql = sprintf("SELECT * FROM `order-details` ORDER BY `order_details_sid` DESC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);

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
    </div>
    <div class="row">
        <div class="col">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?= 1 == $page ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page - 1 ?>">
                            <i class="fa-solid fa-arrow-left"></i>
                        </a>
                    </li>
                    <?php for ($i = $page - 3; $i <= $page + 3; $i++) :
                        if ($i >= 1 and $i <= $totalPages) :
                    ?>
                            <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                            </li>
                    <?php endif;
                    endfor; ?>
                    <li class="page-item <?= $totalPages == $page ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page + 1 ?>">
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">
                            <i class="fa-solid fa-trash"></i>
                        </th>
                        <th scope="col">order_num</th>
                        <th scope="col">member_sid</th>
                        <th scope="col">created_at</th>
                        <th scope="col">unit_total</th>
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
                            <td><?= $r['order_num'] ?></td>
                            <td><?= $r['member_sid'] ?></td>
                            <td><?= $r['created_at'] ?></td>
                            <td><?= $r['total'] ?></td>
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

    function delete_it(order_details_sid) {
        if (confirm(`確定要刪除編號為 ${order_details_sid} 的訂單明細資料嗎?`)) {
            location.href = `delete.php?order_details_sid= ${order_details_sid}`;
        }
    }
</script>
<?php
include __DIR__ . '/parts/html-foot.php'; ?>