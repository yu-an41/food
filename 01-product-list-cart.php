<?php
include __DIR__ . '/parts/connect_db.php';
$pageName = 'list';

$perPage = 10;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// $qsp = [];
//query string parameter

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
<div class="container">
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
                                <? endfor; ?>
                            </select>
                            <button class="btn btn-success add-to-cart-btn" data-sid="<?= $r['sid'] ?>" onclick="addToCart(event)">
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
        const btn = $(event.currentTarget);
        const qty = btn.closest('.card-body').find('select').val();
        const sid = btn.attr('data-sid');

        console.log({ sid, qty});

        $.get('01-handle-cart.php', {
            sid,
            qty
        }, function(data) {
            conutCartObj(data);
            showCartCount(data);
        }, 'json');
    }

    // btn.click(function() {
    //     const sid = $(this).closest('.product-unit').attr('data-sid');
    //     const qty = $(this).closest('.product-unit').find('.qty').val();

    // })
</script>
<?php
include __DIR__ . '/parts/html-foot.php'; ?>