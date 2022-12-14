<?php
require __DIR__ . '/parts/admin-required.php';
require __DIR__ . '/parts/connect_db.php';
$pageName = 'card-insert';

$sql1 = "SELECT * FROM `shop_list`";
$sql2 = "SELECT * FROM `food_category`";

$rows1 = $pdo->query($sql1)->fetchALL();
$rows2 = $pdo->query($sql2)->fetchALL();
?>

<?php require __DIR__ . '/parts/html-head.php'; ?>
<?php include __DIR__ . '/parts/nav-bar-admin.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">新增惜食商品</h5>
                    <img src="" alt="" id="img" style="width: 300px;">
                    <form name="form1" onsubmit="checkForm(); return false;">
                        <div class="mb-3">
                            <label for="picture" class="form-label">惜食照片</label>
                            <input type="file" class="form-control" id="picture" name="picture" accept="image/png,image/jpeg">
                        </div>
                        <div class="mb-3">
                            <label for="shop_name" class="shop_name">惜食商家</label>
                            <select name="shop_name" id="shop_name">
                                <?php foreach ($rows1 as $s) : ?>
                                    <option value="<?= $s['sid'] ?>"><?= $s['shop_name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">惜食名稱</label>
                            <input type="text" class="product_name form-control" id="product_name" name="product_name">
                        </div>
                        <!-- 商品類別 -->
                        <div class="mb-3">
                            <label for="product_categories" class="form-label">惜食類別</label>
                            <select name="product_categories" id="product_categories">
                                <?php foreach ($rows2 as $r) : ?>
                                    <option value="<?= $r['sid'] ?>"><?= $r['product_categories'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="product_description" class="product_description">惜食敘述</label>
                            <textarea class="form-control" name="product_description" id="product_description" cols="50" rows="4"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">定價</label>
                            <input type="text" class="form-control" id="price" name="price">
                        </div>
                        <div class="mb-3">
                            <label for="sale_price" class="form-label">折數</label>
                            <input type="text" class="form-control" id="sale_price" name="sale_price">
                        </div>
                        <button type="submit" class="btn btn-primary">送出</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include __DIR__ . '/parts/scripts.php'; ?>
<script>
    let img = document.querySelector("#img");
    let inp = document.querySelector("#picture");
    inp.addEventListener("change", (evt) => {
        const file = evt.target.files[0];
        img.src = URL.createObjectURL(file)
    })

    function checkForm() {
        const fd = new FormData(document.form1);
        fetch('04-insert-api.php', {
            method: 'POST',
            body: fd
        }).then(r => r.json()).then(obj => {
            // console.log(obj);
            if (!obj.success) {
                alert(obj.error);
            } else {
                alert('已新增惜食商品')
                location.href = '04-product-list.php';
            }
        });

    }
</script>
<?php include __DIR__ . '/parts/html-foot.php'; ?>