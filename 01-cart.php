<?php
include __DIR__ . '/parts/connect_db.php';
$pageName = 'cart';
?>
<?php
include __DIR__ . '/parts/html-head.php'; ?>
<?php
include __DIR__ . '/parts/nav-bar-no-admin.php'; ?>
<div class="container">
    <div class="row d-flex flex-column align-items-end">
        <h4 class="text-center mb-3">我的購物車</h4>
        <div class="col-sm-6 col-md-4 col-lg3 col-xl-2 mb-3">
            <button type="button" class="btn btn-secondary">清空購物車</button>
        </div>
    </div>
    <?php if (empty($_SESSION['cart'])) : ?>
        <div class="alert alert-danger" role="alert">
            購物車內沒有商品
        </div>
    <?php else : ?>
        <div class="row">
            <div class="col">
                <table class="table table-striped table-bordered cart-table">
                    <thead>
                        <tr>
                            <th scope="col">項次</th>
                            <th scope="col">商品名稱</th>
                            <th scope="col">價格</th>
                            <th scope="col">數量</th>
                            <th scope="col">小計</th>
                            <th scope="col">
                                刪除商品</i>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION['cart'] as $c => $v) :
                            $total += $v['price'] * $v['qty'];
                        ?>
                            <tr data-sid="<?= $k ?>" class="cart-item">
                                <td><?= $k ?></td>
                                <td><?= $k['product_name'] ?></td>
                                <td>
                                    <select class="w-75 form-select">
                                        <option selected>選擇數量</option>
                                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                                            <option value="<?= $i ?>"><?= $i ?></option>
                                        <? endfor; ?>
                                    </select>
                                </td>
                                <td class="sub-total"></td>
                                <td>
                                    <a href="javascript: " onclick="removeItem(event)">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="alert alert-success" role="alert">
            <span>總計：</span id="total-price"><span></span>元
        </div>
        <div>
            <?php if (empty($_SESSION['user'])) : ?>
                <div class="alert alert-danger" role="alert">
                    請先登入會員, 再結帳
                </div>
            <?php else : ?>

            <?php endif; ?>
        </div>
    <? endif; ?>
</div>
<?php
include __DIR__ . '/parts/scripts.php'; ?>
<?php
include __DIR__ . '/parts/html-foot.php'; ?>