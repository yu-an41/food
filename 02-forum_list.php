<?php 
require __DIR__ . '/parts/connect_db.php';

if (empty($_SESSION['admin'])) {
    header('Location: 00-login-form-admin.php');
}
$pageName = 'list';
$perPage = 5;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$t_sql = "SELECT COUNT(1) FROM official_post";
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];

$totalPages = ceil($totalRows / $perPage);
//echo $totalPages;//結果顯示出資量總共兩頁
$row = [];

if ($totalRows) {
    if ($page < 1) {
        header('Location: ?page=1');
        exit;
    }
    if ($page > $totalPages) {
        header('Location: ?page=' . $totalPages);
        exit;
    }
    $sql = sprintf(
        "SELECT * FROM official_post LIMIT %s, %s",
        ($page - 1) * $perPage,
        $perPage
    );
    $row = $pdo->query($sql)->fetchALL();
}
$output = [
    'totalRows' => $totalRows,
    'totalPages' => $totalPages,
    'page' => $page,
    'row' => $row,
    'perPage' => $perPage,
];

?>
<?php include __DIR__ . '/parts/html-head.php'; ?>
<?php include __DIR__ . '/parts/nav-bar-admin.php'; ?>

<div class="container">
    <div class="row">
        <nav class="mb-3">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-list-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab">列表</button>
                <button class="nav-link" id="nav-comment-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab">留言</button>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" tabindex="0">
                <div class="col d-flex flex-row justify-content-between">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item <?= 1 == $page ? 'disabled' : '' ?>">
                                <a class="page-link" href="?page=<?= $page - 1 ?>">
                                    <i class="fa-solid fa-circle-arrow-left"></i>
                                </a>
                            </li>

                            <?php for ($i = $page - 5; $i <= $page + 5; $i++) :
                                if ($i >= 1 and $i <= $totalPages) :
                            ?>
                                    <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                    </li>
                            <?php
                                endif;
                            endfor; ?>

                            <li class="page-item <?= $totalPages == $page ? 'disabled' : '' ?>">
                                <a class="page-link" href="?page=<?= $page + 1 ?>">
                                    <i class="fa-solid fa-circle-arrow-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <a href="02-insert_forms.php" type="button" class="btn btn-primary" style="height: 40px;">
                        新增文章
                    </a>
                </div>
                <?php
                // if(! empty($_SESSION['admin'])){
                include __DIR__ . '/02-official_table_admin.php';
                // }
                ?>
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" tabindex="0">...</div>

        </div>
    </div>
</div>

<?php include __DIR__ . '/parts/scripts.php'; ?>
<?php include __DIR__ . '/parts/html-foot.php'; ?>