<?php
include __DIR__ . '/parts/connect_db.php';
$pageName = 'list';

$perPage = 5;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$sql = "SELECT * FROM `category` WHERE 1";

$t_sql = "SELECT COUNT(1) FROM `product-list` WHERE 1";
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];

$totalPages = ceil($totalRows / $perPage);
if ($page < 1) {
    $page = 1;
}
if ($page > $totalPages) {
    $page = $totalPages;
}

$rows = [];

if ($totalRows > 0) {
    if ($page > 1) {
        header('Location: ?page = 1');
        exit;
    }
    if ($page > $totalPages) {
        header('Location: ?page= .$totalPages');
        exit;
    }
    $sql = sprintf("SELECT * FROM `product-list` ORDER BY `product_sid` DESC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);

    $rows = $pdo->query($sql)->fetchAll();
}
// echo json_encode([
//     'totalRows' => $totalRows,
//     'totalPages' => $totalPages,
//     'perPage' => $perPage,
//     'page' => $page,
//     'rows' => $rows,
// ]);
// exit;

?>
<?php
include __DIR__ . '/parts/html-head.php'; ?>
<?php
include __DIR__ . '/parts/nav-bar-no-admin.php'; ?>
<div class="container">
    <div class="row">
        <div class="col">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?= 1 === $page ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page= .'<?= $page - 1 ?>'">
                            <i class="fa-solid fa-arrow-left"></i>
                        </a>
                    </li>
                    <?php for ($i = $page - 2; $i <= $page + 2; $i++) :
                        if ($i >= 1 and $i <= $totalPages) :
                    ?>
                            <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                                <a class="page-link" href="?page= .'<?= $page ?>'">
                                    <?= $i ?>
                                </a>
                            </li>
                    <?php endif;
                    endfor; ?>
                    <li class="page-item <?= $totalPages === $page ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page + 1 ?>">
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="row d-flex flex-row justify-content-start align-content-between">
        <?php foreach ($rows as $r) : ?>
            <div class="col-md-3 mb-3">
                <div class="card h-100 d-flex flex-column h-100" style="min-width: 12rem;">
                    <img src="<?= $r['product_image'] ?>" class="card-img-top" style="height: 180px; object-fit: cover;">
                    <div class="card-body d-flex flex-column justify-content-start align-items-start h-100">
                        <h6 class="card-title"><?= $r['product_name'] ?></h6>
                        <p class="card-text flex-grow-1"><?= $r['product_description'] ?></p>
                        <p class="card-text">＄<?= $r['product_price'] ?></p>
                        <form class="w-75 d-flex flex-row  justify-content-around px-1 mb-4">
                            <select name="" id="" class="form-control qty " style="display: inline-block; width: auto">
                                <option selected disabled>請選擇數量</option>
                                <?php for ($i = 1; $i <= 5; $i++) : ?>
                                    <option value="<?= $i ?>"><?= $i ?></option>
                                <? endfor; ?>
                            </select>
                            <button type="button" class="btn btn-success add-to-cart-btn">
                                <i class="fa-solid fa-cart-shopping"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php
include __DIR__ . '/parts/scripts.php'; ?>
<script>
    const fd = document.formProduct;

    function addToCart() {
        fetch('cart.php', {
                method: 'POST',
                body: fd,
            })
            .then(r => r.json())
            .then(obj => {
                console.log(obj);
            })

    }
</script>
<?php
include __DIR__ . '/parts/html-foot.php'; ?>