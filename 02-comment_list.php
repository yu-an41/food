<?php require __DIR__ . '/parts/connect_db.php';

$pageName2 = 'comment_list';
$perPage2 = 5;
$page2 = isset($_GET['page']) ? intval($_GET['page']) : 1;
$ｃ_sql = "SELECT COUNT(1) FROM comment";
$totalRows2 = $pdo->query($ｃ_sql)->fetch(PDO::FETCH_NUM)[0];

$totalPages2 = ceil($totalRows2 / $perPage2);
//echo $totalPages;//結果顯示出資量總共兩頁
$row2 = [];

if ($totalRows2) {
    if ($page2 < 1) {
        header('Location: ?page=1');
        exit;
    }
    if ($page2 > $totalPages2) {
        header('Location: ?page=' . $totalPages2);
        exit;
    }
    $sql2 = sprintf(
        "SELECT * FROM comment LIMIT %s, %s",
        ($page2 - 1) * $perPage2,
        $perPage2
    );
    $row2 = $pdo->query($sql2)->fetchALL();
}
$output = [
    'totalRows' => $totalRows2,
    'totalPages' => $totalPages2,
    'page' => $page2,
    'row' => $row2,
    'perPage' => $perPage2,
];

?>
<?php include __DIR__ . '/parts/html-head.php'; ?>


<div class="col d-flex flex-row justify-content-between">
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item <?= 1 == $page2 ? 'disabled' : '' ?>">
                <a class="page-link" href="?page=<?= $page2 - 1 ?>">
                    <i class="fa-solid fa-circle-arrow-left"></i>
                </a>
            </li>

            <?php for ($k = $page2 - 5; $k <= $page2 + 5; $k++) :
                if ($k >= 1 and $k <= $totalPages2) :
            ?>
                    <li class="page-item <?= $k == $page2 ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $k ?>"><?= $k ?></a>
                    </li>
            <?php
                endif;
            endfor; ?>

            <li class="page-item <?= $totalPages2 == $page2 ? 'disabled' : '' ?>">
                <a class="page-link" href="?page=<?= $page2 + 1 ?>">
                    <i class="fa-solid fa-circle-arrow-right"></i>
                </a>
            </li>
        </ul>
    </nav>
</div>
<table class="table table-striped table-bordered">
    <thead>
        <tr>

            <th scope="col">刪除</th>
            <th scope="col">留言編號</th>
            <th scope="col">會員帳號</th>
            <th scope="col">文章分類</th>
            <th scope="col">文章編號</th>
            <th scope="col">留言內容</th>
            <th scope="col">回覆分類</th>
            <th scope="col">建立時間</th>

        </tr>
    </thead>
    <tbody>
        <?php foreach ($row2 as $r) : ?>
            <tr>
                <!--新增垃圾桶icon  -->
                <td>
                    <a href="02-delete_comment.php?sid=<?= $r['sid'] ?>" onclick="return confirm('確定要刪除編號為<?= $r['sid'] ?>的資料嗎?')">
                        <i class="fa-solid fa-trash-can"></i>
                    </a>
                </td>
                <td><?= $r['sid'] ?></td>
                <td><?= $r['member_sid'] ?></td>
                <td><?= $r['categories_sid'] ?></td>
                <td><?= $r['post_sid'] ?></td>
                <td><?= $r['content'] ?></td>
                <td><?= $r['parent_sid'] ?></td>
                <td><?= $r['created_at'] ?></td>

            </tr>
        <?php endforeach; ?>
    </tbody>

</table>