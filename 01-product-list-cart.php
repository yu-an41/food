<?php
require __DIR__ . '/parts/connect_db.php';
$pageName = 'productCart';

$perPage = 10;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$t_sql = "SELECT COUNT(1) FROM `product-list`";
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
include __DIR__ . '/parts/nav-bar-no-admin.php'; ?>
<form id="form1" class="d-none">
    <input id="sid" name="sid" type="text">
    <input id="qty" name="qty" type="text">
</form>
<div class="container">
    <div class="row">
        <h4 class="text-center mb-3">商品一覽</h4>
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
        <div class="col-lg-6 d-flex flex-row-reverse mb-2  ">
            <a class="btn btn-success" href="01-cart.php" style="height: 40px;">
                <i class="fa-solid fa-cart-shopping"> 我的購物車</i>
            </a>
        </div>
    </div>
    <div class="row d-flex flex-row justify-content-start align-content-between flex-wrap">
        <?php foreach ($rows as $r) : ?>
            <div class="col-md-3 mb-3" style="max-width: 22rem; min-width: 12rem">
                <div class="card h-100 d-flex flex-column h-100" style="min-width: 12rem;">
                    <img src="<?= $r['product_image'] ?>" class="card-img-top" style="height: 180px; object-fit: cover;">
                    <div class="card-body d-flex flex-column justify-content-start align-items-start h-100">
                        <h5 class="card-title"><?= $r['product_name'] ?></h5>
                        <p class="card-text flex-grow-1"><?= $r['product_description'] ?></p>
                        <p class="card-text">＄<?= $r['product_price'] ?></p>
                        <div class="form-group w-100 d-flex flex-row  justify-content-around px-1 mb-4">
                            <select class="form-select" style="display: inline-block; min-width: 8rem; max-width: 12rem;">
                                <?php for ($i = 1; $i <= 5; $i++) : ?>
                                    <option value="<?= $i ?>"><?= $i ?></option>
                                <?php endfor; ?>
                            </select>
                            <button class="btn btn-success" data-sid="<?= $r['product_sid'] ?>" onclick="addToCart(event)">
                                <i class="fa-solid fa-cart-shopping"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php
include __DIR__ . '/parts/scripts.php'; ?>
<script>
    function addToCart(event) {
        const sid = document.querySelector('#sid');
        const qty = document.querySelector('#qty');

        const mySid = event.currentTarget.getAttribute('data-sid');
        const myQty = event.currentTarget.parentNode.querySelector('.form-select').value;
        // console.log(myQty);
        // console.log(btn);

        sid.value = mySid;
        if (myQty <= 10) {
            qty.value = myQty;
        } else {
            qty.value = 10;
            myQty.value = 10;
        }

        const fd = new FormData(document.querySelector('#form1'));

        fetch('01-handle-cart.php', {
                method: 'POST',
                body: fd
            })
            .then(r => r.json())
            .then(obj => {
                console.log(obj);
            })
        alert('商品已加入購物車！');
    }
</script>
<?php
include __DIR__ . '/parts/html-foot.php'; ?>