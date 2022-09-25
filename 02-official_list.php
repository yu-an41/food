<?php require __DIR__ . '/parts/connect_db.php';

$pageName = 'official_list';
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


<table class="table table-striped table-bordered">
    <thead>
        <tr>

            <th scope="col">刪除</th>
            <th scope="col">編號</th>
            <th scope="col">標題</th>
            <th scope="col">圖片</th>
            <!-- <th scope="col">影片</th> -->
            <th scope="col">內文</th>
            <th scope="col">標籤</th>
            <th scope="col">建立時間</th>
            <th scope="col">編輯</th>

        </tr>
    </thead>
    <tbody>
        <?php foreach ($row as $r) : ?>
            <tr>
                <!--新增垃圾桶icon  -->
                <td>
                    <a href="02-delete.php?sid=<?= $r['sid'] ?>" onclick="return confirm('確定要刪除編號為<?= $r['sid'] ?>的資料嗎?')">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>
                </td>
                <td><?= $r['sid'] ?></td>
                <td><?= $r['title'] ?></td>
                <td><img src="./uploads/<?= $r['img'] ?>" style="width: 150px;"></td>

                <td><?= $r['content'] ?></td>
                <td><?= $r['hashtag'] ?></td>
                <td><?= $r['created_at'] ?></td>
                <!--新增編輯icon  -->
                <td>
                    <a href="02-edit_forms.php?sid=<?= $r['sid'] ?>">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                </td>

            </tr>
        <?php endforeach; ?>
    </tbody>

</table>