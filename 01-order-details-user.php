<?php
include __DIR__ . '/parts/connect_db.php';
$pageName = 'orderDetails';
?>
<?php
include __DIR__ . '/parts/html-head.php'; ?>
<?php
include __DIR__ . '/parts/nav-bar.php'; ?>
<div class="container">
    <div class="row">
        <div class="col">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">
                            <i class="fa-solid fa-trash"></i>
                        </th>
                        <th scope="col">order_sid</th>
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

    function delete_it(order_details_sid) {
        if (confirm(`確定要刪除編號為 ${order_details_sid} 的訂單資料嗎?`)) {
            location.href = `delete.php?sid= ${order_details_sid}`;
        }
    }
</script>
<?php
include __DIR__ . '/parts/html-foot.php'; ?>