<?php
require __DIR__ . '/parts/connect_db.php';
$pageName = 'cart';

?>
<?php
include __DIR__ . '/parts/html-head.php'; ?>
<?php
include __DIR__ . '/parts/nav-bar-no-admin.php'; ?>
<div class="container">
    <div class="row d-flex flex-column align-items-end">
        <h4 class="text-center mb-3">我的購物車</h4>
        <!-- <div class="col-sm-6 col-md-4 col-lg3 col-xl-2 mb-3">
            <button type="button" class="btn btn-secondary">清空購物車</button>
        </div> -->
    </div>
    <?php if (empty($_SESSION['cart'])) : ?>
        <div class="alert alert-danger" role="alert">
            購物車內沒有商品
        </div>
    <?php else : ?>
        <form id="formCart">
            <input type="text" name="sid" id="sid">
            <!-- <input type="text" name="qty" id="qty"> -->
        </form>
        <div class="row">
            <div class="col">
                <table class="table table-striped table-bordered cart-table">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">商品名稱</th>
                            <th scope="col">價格</th>
                            <th scope="col">數量</th>
                            <th scope="col">小計</th>
                            <th scope="col">
                                <i class="fa-solid fa-trash"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        foreach ($_SESSION['cart'] as $k => $v) :
                            $total += $v['product_price'] * $v['qty'];
                        ?>
                            <tr data-sid="<?= $v['product_sid'] ?>" class="cart-item">
                                <td><img src="<?= $v['product_image'] ?>" style="width: 100px; height:80px; object-fit: cover;"></td>
                                <td><?= $v['product_name'] ?></td>
                                <td><?= $v['product_price'] ?></td>
                                <td>
                                    <select class="w-75 form-select qty">
                                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                                            <option value="<?= $i ?>" <?= $i == $v['qty'] ? 'selected' : '' ?>>
                                                <?= $i ?></option>
                                        <? endfor; ?>
                                    </select>
                                </td>
                                <td class="sub-total">
                                    <?= $v['product_price'] * $v['qty'] ?>
                                </td>
                                <td>
                                    <a href="javascript: " onclick="removeItem(event)" class="btn btn-warning">
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
            <span>總計：</span id="total-price"> <?= $total ?> <span></span>元
        </div>
        <?php /*if (empty($_SESSION['user'])) : */ ?>
        <!-- <div class="alert alert-danger" role="alert">
                請先登入會員，再結帳
            </div> -->
        <?php /*else :*/ ?>
        <a href="01-buy.php" class="btn btn-warning">結帳</a>
        <?php /*endif;*/ ?>
    <? endif; ?>
</div>
<?php
include __DIR__ . '/parts/scripts.php'; ?>
<script>
    function removeItem(event) {
        const sid = document.querySelector('#sid');
        // const qty = document.querySelector('#qty');
        console.log(event.currentTarget);
        // const mySid = event.currentTarget.parentNode.querySelector('#sid').getAttribute('data-sid');
        // sid.value = mySid;
        // console.log(mySid);

        const fd = new FormData(document.formCart);

        fetch('01-handle-cart.php', {
                metho: 'POST',
                body: fd
            })
            .then(r => r.json())
            .then(obj => {
                console.log(obj);
            })
    }
</script>
<?php
include __DIR__ . '/parts/html-foot.php'; ?>