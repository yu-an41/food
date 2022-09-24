<?php
require __DIR__ . '/parts/admin-required.php';
require __DIR__ . '/parts/connect_db.php';
$pageName = 'shop-edit';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
if (empty($sid)) {
    header('Location: shop-list.php');
    exit;
}

$sql = "SELECT * FROM `shop_list` WHERE sid=$sid";
$r = $pdo->query($sql)->fetch();
if (empty($r)) {
    header('Location: shop-list.php');
    exit;
}

?>
<?php require __DIR__ . '/parts/html-head.php'; ?>
<?php include __DIR__ . '/parts/nav-bar-admin.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">

                <div class="card-body">
                    <h5 class="card-title">修改店家資料</h5>
                    <img src="./uploads/<?= $r['shop_cover'] ?>" alt="" id="shop_img" style="width: 300px;">
                    <form name="form1" onsubmit="checkForm(); return false;" novalidate>
                        <input type="hidden" name="sid" value="<?= $r['sid'] ?>">
                        <label for="shop_cover" class="form-label">店家封面</label>
                        <div class="mb-3">
                            <input type="file" class="form-control" id="shop_cover" name="shop_cover" value="<?= $r['shop_cover'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="shop_email" class="form-label">帳號信箱</label>
                            <input type="email" class="form-control" id="shop_email" name="shop_email" value="<?= $r['shop_email'] ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="shop_password" class="form-label">店家密碼</label>
                            <input type="password" class="form-control" id="shop_password" name="shop_password" value="<?= $r['shop_password'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="shop_name" class="form-label">店家名稱</label>
                            <input type="text" class="form-control" id="shop_name" name="shop_name" value="<?= htmlentities($r['shop_name']) ?>">
                        </div>
                        <div class="mb-3">
                            <label for="shop_phone" class="form-label">店家電話</label>
                            <input type="text" class="form-control" id="shop_phone" name="shop_phone" value="<?= $r['shop_phone'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">店家地址</label>
                            <input id="selectcity" name="shop_address_city" value="<?= $r['shop_address_city'] ?>"></input>
                            <input id="selectarea" name="shop_address_area" value="<?= $r['shop_address_area'] ?>"></input>
                            <input type="text" class="form-control" id="address" name="shop_address_detail" value="<?= $r['shop_address_detail'] ?>">
                        </div>
                        <div class="mb-3 d-flex">
                            <label for="shop_opentime" class="form-label">開店時間</label><br>
                            <input name="shop_opentime" id="shop_opentime" value="<?= $r['shop_opentime'] ?>">
                            </input>
                            <label for="shop_closetime" class="form-label">關店時間</label><br>
                            <input name="shop_closetime" id="shop_closetime" value="<?= $r['shop_closetime'] ?>">
                            </input>
                        </div>
                        <div class="mb-3">
                            <label for="shop_deadline" class="form-label">取餐截止時間</label>
                            <input type="text" class="form-control" id="shop_deadline" name="shop_deadline" value="<?= $r['shop_deadline'] ?>">
                        </div>
                        <div>
                        <input class="form-check-input mb-4" type="radio" name="enable_disable" id="enable" value="1" <?= $r['shop_approved'] == 1 ? 'checked' : '' ?> onclick="return confirm('確定店家資格改為核准上架嗎?')">
                        <label class="form-check-label" for="enable">
                            可上架
                        </label>
                        <input class="form-check-input mb-4" type="radio" name="enable_disable" id="disable" value="0" <?= $r['shop_approved'] == 0 ? 'checked' : '' ?> onclick="return confirm('確定店家資格改為審查中嗎')">
                        <label class="form-check-label" for="disable">
                            審查中
                        </label>
                        </div>
                        <button type="submit" class="btn btn-primary">確認送出</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<?php include __DIR__ . '/parts/scripts.php'; ?>
<script>
    let img = document.querySelector("#shop_img");
    let cover = document.querySelector("#shop_cover");

    cover.addEventListener("change", (evt) => {
        const file = evt.target.files[0];
        img.src = URL.createObjectURL(file);
    })

    function checkForm() {

        const fd = new FormData(document.form1);

        fetch('03-shop-edit-api.php', {
            method: 'POST',
            body: fd
        }).then(r => r.json()).then(obj => {
            console.log(obj);
            if (!obj.success) {
                alert(obj.error);
            } else {
                alert('修改成功')
                location.href = '03-shop-list.php';
            }
        })


    }
</script>
<?php include __DIR__ . '/parts/html-foot.php'; ?>