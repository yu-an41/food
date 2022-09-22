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
                            <th scope="col">#</th>
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
                            $total += $v['prce'] * $v['qty'];
                        ?>
                            <tr data-sid="<?= $k ?>" class="cart-item">
                                <td><?= $k ?></td>
                                <td><?= $k['product_name'] ?></td>
                                <td>
                                    <select class="w-75 form-select qty" onchange="updateItem(event)">
                                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                                            <option value="<?= $i == $V['qty'] ? 'selected' : '' ?>"><?= $i ?></option>
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
        <?php if (empty($_SESSION['user'])) : ?>
            <div class="alert alert-danger" role="alert">
                請先登入會員, 再結帳
            </div>
        <?php else : ?>
            <a href="buy.php" class="btn btn-warning">結帳</a>
        <?php endif; ?>
    <? endif; ?>
</div>
<?php
include __DIR__ . '/parts/scripts.php'; ?>
<script>
    const dollorCommas = function(n) {
        return n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    };

    function removeItem(event){
        const tr = $(event.currentTarget).closest('tr');
        const sid = tr.attr('data-sid');

        $.get(
            '01-handle-cart.php', {
                sid
            },
            function(data) {
                console.log(data);
                showCartCount(data);
                tr.remove();

                updatePrices();
            },
            'json');
    }

    function updateItem(event) {
        const sid = $(event.currentTarget).closest('tr').attr('data-sid');
        const qty = $(event.currentTarget).val();

        $.get(
            '01-handle-cart.php', {
                sid,
                qty
            },
            function(data) {
                console.log(data);
                showCartCount(data);

                updatePrices();
            },
            'json');
    }

    function updatePrices(){
        let total = 0;

        $('.cart-item').each(function(){
            const tr = $(this);
            const td_price = tr.find('product_price');
            const td_sub = tr.find('.sub-total');

            const price = +td_price.attr('data-val');
            const qty = +tr.find('qty').val();

            td_price.html('$ ' + dollorCommas(price));
            td_sub.html('$ ' + dollorCommas(price) * qty);
            total += price * qty;

        });
        $('#total-price').html('$ ' + dollorCommas(total));
    }
    updatePrices();
</script>
<?php
include __DIR__ . '/parts/html-foot.php'; ?>