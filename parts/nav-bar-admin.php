<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<style>
    nav.navbar .nav-item .nav-link.active {
        background-color: coral;
        color: white;
        font-weight: bold;
        border-radius: 10px;
    }
</style>
<div class="container mb-3">
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">管理選單</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?= $pageName == 'baseAdmin' ? 'active' : '' ?>" href="00-basepage-admin.php">首頁</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link <?= $pageName == 'mb_list' ? 'active' : '' ?>" href="05-mb_list.php">一般會員</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link <?= $pageName == 'shop-list' ? 'active' : '' ?>" href="03-shop-list.php">店家</a>
                    </li>
                    <li class="nav-item <?= $pageName == 'productCart' ? 'active' : '' ?>">
                        <a class="nav-link" href="04-product-list.php">商品列表</a>
                    </li>
<<<<<<< HEAD
                    <li class="nav-item">
                        <a class="nav-link <?= $pageName == 'event' ? 'active' : '' ?>" href="06-list.php">活動</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $pageName == 'list' ? 'active' : '' ?>" href="02-forum_list.php">論壇</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $pageName == 'orderHistory' ? 'active' : '' ?>" href="01-order-history-admin.php">訂單</a>
=======
                    <li class="nav-item <?= $pageName == 'forum' ? 'active' : '' ?>">
                        <a class="nav-link <?= $pageName == 'product' ? 'active' : '' ?>" href="02-official_list.php">論壇</a>
                    </li>
                    <li class="nav-item <?= $pageName == 'cart' ? 'active' : '' ?>">
                        <a class="nav-link" href="cart.php">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </a>
                    </li>
>>>>>>> a4ab90ced490be36bcc2572233ac416f0b08a22d
                </ul>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <?php if (empty($_SESSION['admin'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="00-login-form-admin.php">登入</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link"><?= $_SESSION['admin']['account'] ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="00-logout-admin.php">登出</a>
                        </li>
                    <?php endif; ?>
                </ul>

            </div>
        </div>
    </nav>
</div>