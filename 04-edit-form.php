<?php
require __DIR__ . '/parts/admin-required.php';
require __DIR__ . '/parts/connect_db.php';
$pageName = 'product-edit';


$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
if (empty($sid)) {
    header('Location: 04-product-list.php');
    exit;
}

$sql = "SELECT `food_product`.* ,`food_category`.`product_categories`
        FROM `food_product`
        JOIN `food_category` 
        ON `food_category`.`sid` = `food_product`.`product_categories_sid`
        WHERE `food_product`.sid = $sid";

$r = $pdo->query($sql)->fetch();
if (empty($r)) {
    header('Location: 04-product-list.php');
    exit;
}
$sql = "SELECT * FROM `food_category`";
$rows = $pdo->query($sql)->fetchALL();

?>
<?php include __DIR__ . '/parts/html-head.php'; ?>
<?php include __DIR__ . '/parts/nav-bar-admin.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">修改商品資料</h5>

                    <img src="./img/<?= $r['product_picture'] ?>" alt="" id="img" style="width: 300px;">

                    <form name="form1" onsubmit="checkForm(); return false;" novalidate>
                        <div class="mb-3">
                            <label for="picture" class="form-label"></label>
                            <input type="file" class="form-control" id="picture" name="picture" accept="image/png,image/jpeg">
                        </div>
                        <div class="mb-3">
                            <label for="sid1" class="form-label"></label>
                            <input type="hidden" class="form-control" id="sid1" name="sid1" value="<?= ($r['sid']) ?> ">
                        </div>
                        <div class="mb-3">
                            <label for="product_categories" class="form-label">商品類別</label>
                            <select name="product_categories" id="product_categories">
                                <?php foreach ($rows as $c) : ?>
                                    <option value="<?= $c['sid'] ?>"><?= $c['product_categories'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="product_name" class="form-label">商品名</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" value="<?= $r['product_name'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="product_description" class="fproduct_description">商品敘述</label>
                            <textarea class="form-control" name="product_description" id="product_description" cols="50" rows="4"><?= $r['product_description'] ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="unit_price" class="form-label">定價</label>
                            <input type="text" class="form-control" id="unit_price" name="unit_price" value="<?= $r['unit_price'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="sale_price" class="form-label">折數</label>
                            <input type="text" class="form-control" id="sale_price" name="sale_price" value="<?= $r['sale_price'] ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include __DIR__ . '/parts/scripts.php'; ?>
<script>
    let pic = document.querySelector("#picture")
    let con = document.querySelector("#img")
    pic.addEventListener("change", (evt) => {
        const file = evt.target.files[0];
        con.src = URL.createObjectURL(file);
    })

    function checkForm() {
        const fd = new FormData(document.form1);
        fetch('04-edit-api.php', {
            method: 'POST',
            body: fd
        }).then(r => r.json()).then(obj => {
            console.log(obj);
            if (!obj.success) {
                alert(obj.error);
            } else {
                alert('修改成功')
                location.href = '04-product-list.php';
            }
        })
    }
</script>
<?php include __DIR__ . '/parts/html-foot.php'; ?>