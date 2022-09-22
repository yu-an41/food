
<?php include __DIR__ . '/parts/connect_db.php';
$pageName = 'list';

$perPage = 2; #一頁有幾筆
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$t_sql = "SELECT COUNT(1) FROM event_test_1 ";
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];

$totalPages = ceil($totalRows / $perPage);

$rows = [];
//如果有資料
if ($totalRows) {
    if ($page < 1) {
        header('Location: ?=1'); //等於('Location:list.php')
        exit;
    }
    if ($page > $totalPages) {
        header('Location: ?=' . $totalPages);
    }
    $sql = sprintf(
        "SELECT * FROM event_test_1 ORDER BY sid LIMIT %s, %s",
        ($page - 1) * $perPage,
        $perPage
    );
    $rows = $pdo->query($sql)->fetchAll();
}


$output = [
    'totalRows' => $totalRows,
    'totalPages' => $totalPages,
    'page' => $page,
    'rows' => $rows,
];
//echo json_encode($output);exit;
?>

<?php include __DIR__ . '/parts/html-head.php'; ?>
<?php include __DIR__ . '/parts/navbar.php'; ?>
<div class="container">
    <div class="row">
        <div class="col">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page - 1 ?>">
                            <i class="fa-regular fa-circle-left"></i>
                        </a>
                    </li>

                    <?php
                    for ($i = $page - 5; $i <= $totalPages + 5; $i++) : //最多顯示多少
                        if ($i >= 1 and $i <= $totalPages) : //顯示在合理範圍內ＳＳ
                    ?>
                            <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                            </li>

                    <?php
                        endif;
                    endfor;
                    ?>

                    <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page + 1 ?>">
                            <i class="fa-regular fa-circle-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col"><i class="fa-solid fa-trash-can"></i></th>
                        <th scope="col">#</th>
                        <th scope="col">圖片</th>
                        <th scope="col">名稱</th>
                        <th scope="col">活動說明</th>
                        <th scope="col">地點</th>
                        <th scope="col">標籤</th>
                        <th scope="col">活動日期</th>
                        <th scope="col">人數限制</th>
                        <th scope="col">主辦單位</th>
                        <th scope="col">票價</th>
                        <th scope="col">成立時間</th>
                        <th scope="col"><i class="fa-solid fa-pen-to-square"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $r) : ?>
                        <tr>
                            <td><a href="delete.php?sid=<?= $r['sid'] ?>"
                            onclick="return confirm('確定要刪除編號為<?= $r['sid'] ?>的資料嗎?')">
                            <i class="fa-solid fa-trash-can"></i>
                            </a></td>
                            <td><?= $r['sid'] ?></td>
                            <td><img src="./uploads/<?= $r['images'] ?>" style="width: 300px;" alt=""></td>
                            <td><?= $r['name'] ?></td>
                            <td><?= $r['content'] ?></td>
                            <td><?= $r['location'] ?></td>
                            <td><?= $r['tags'] ?></td>
                            <td><?= $r['date'] ?></td>
                            <td><?= $r['restricted_maximum'] ?></td>
                            <td><?= $r['host'] ?></td>
                            <td><?= $r['price'] ?></td>
                            <td><?= $r['created_at'] ?></td>
                            <td><a href="edit-form.php?sid=<?= $r['sid'] ?>">
                            <i class="fa-solid fa-pen-to-square"></i>
                            </a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>
<?php include __DIR__ . '/parts/scripts.php'; ?>
<script>
    const table = document.querySelector('table');
    table.addEventListener('click',function(event){
        const t = event.target;
        console.log(event.target);
        if(t.classList.contains('fa-trash-can')){
            t.closest('tr').remove();
        }
        if(t.classList.contains('fa-pen-to-square')){
            console.log(
                t.closest('tr').querySelectorAll('td')[2].innerHTML
            );
        }
    })
</script>
<?php include __DIR__ . '/parts/html-foot.php'; ?>