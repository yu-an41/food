<?php require __DIR__ . '/parts/connect_db.php';
// if (empty($_SESSION['user'])) {
//     header('Location: login-form-admin.php');
// }
$pageName = 'card';
$perPage = 6;
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
        "SELECT * FROM official_post ORDER BY sid DESC LIMIT %s, %s",
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
<?php include __DIR__ . '/parts/nav-bar-no-admin.php'; ?>

<div class="container">
    <div class="row">
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
                </div>
                <div class="container">
                    <div class="row">
                        <?php foreach ($row as $r) : ?>
                            <div class="col-lg-4">
                                <div class="card m-3" style="width: 18rem;">
                                    <img src="./uploads/<?= $r['img'] ?>" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $r['title'] ?></h5>
                                        <p class="card-text"><?= $r['content'] ?></p>
                                        <a href="02-official_post.php?sid=<?= $r['sid'] ?>" class="btn btn-primary">閱讀完整文章</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/parts/scripts.php'; ?>
<?php include __DIR__ . '/parts/html-foot.php'; ?>