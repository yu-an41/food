<?php
require __DIR__ . '/parts/admin-required.php';
require __DIR__ . '/parts/connect_db.php';
$pageName = 'product-list';

$perPage = 20; // 一頁有幾筆
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// 算總筆數
$t_sql = "SELECT COUNT(1) FROM food_product";
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
$totalPages = ceil($totalRows / $perPage);
$rows = [];

// 如果有資料
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
        "SELECT `food_product`.*, `shop_list`.`shop_name`,`shop_list`.`shop_deadline`, `food_category`.`product_categories`
        FROM `food_product`
        JOIN `shop_list` 
        ON `food_product`.`shop_list_sid`=`shop_list`.`sid`
        JOIN `food_category` 
        ON `food_product`.`product_categories_sid`=`food_category`.`sid` 
        ORDER BY `food_product`.`sid` ASC LIMIT %s, %s",
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
    'perPage' => $perPage,
];

?>
<?php include __DIR__ . '/parts/html-head.php'; ?>
<?php include __DIR__ . '/parts/nav-bar-admin.php'; ?>
<div class="container">
    <div class="row d-flex flex-row jusitfy-content-around">
        <div class="col">
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
        <div class="col-lg-6 d-flex flex-row-reverse mb-2">
            <a href="04-insert-form.php" class="btn btn-success">新增商品</a>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">惜食編號</th>
                        <th scope="col">惜食商家</th>
                        <th scope="col">惜食照</th>
                        <th scope="col">惜食名稱</th>
                        <th scope="col">惜食類別</th>
                        <th scope="col">惜食敘述</th>
                        <th scope="col">定價</th>
                        <th scope="col">折數</th>
                        <th scope="col">取餐截止時間</th>
                        <th scope="col">惜食狀態</th>
                        <!-- <th scope="col">建立時間</th> -->
                        <th scope="col">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $r) : ?>
                        <tr>
                            <td><?= $r['sid'] ?></td>
                            <td><?= $r['shop_name'] ?></td>
                            <td>
                                <div class="contanier" style="width:150px; height:180px; ">
                                    <img src="./img/<?= $r['product_picture'] ?>" alt="" style="width:100%; height:100%;object-fit:cover; overflow:hidden;">
                                </div>
                            </td>
                            <td><?= $r['product_name'] ?></td>
                            <td><?= $r['product_categories'] ?></td>
                            <td><?= $r['product_description'] ?></td>
                            <td><?= $r['unit_price'] ?></td>
                            <td><?= $r['sale_price'] ?></td>
                            <td><?= $r['shop_deadline'] ?></td>
                            <td><?= $r['product_launch'] == 1 ? "上架" : "下架" ?></td>
                            <!-- <td><?= $r['created_at'] ?></td> -->
                            <td>
                                <a href="04-edit-form.php?sid=<?= $r['sid'] ?>">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php include __DIR__ . '/parts/scripts.php'; ?>
    <?php include __DIR__ . '/parts/html-foot.php'; ?>