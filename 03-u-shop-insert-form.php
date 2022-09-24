<?php
require __DIR__ . '/parts/connect_db.php';
$pageName = 'shop-insert';
?>

<?php require __DIR__ . '/parts/html-head.php'; ?>
<?php include __DIR__ . '/parts/nav-bar-no-admin.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">註冊店家資料</h5>
                    <img src="" alt="" id="shop_img" style="width: 300px;">
                    <form name="form1" onsubmit="checkForm(); return false;">
                        <div class="mb-3">
                            <label for="shop_cover" class="form-label">店家封面<span style="color:red;font-size:14px;">*必填</span></label>
                            <input type="file" class="form-control" id="shop_cover" name="shop_cover" accept="image/png,image/jpeg">
                        </div>
                        <div class="mb-3">
                            <label for="shop_email" class="form-label">帳號信箱<span style="color:red;font-size:14px;">*必填</span></label>
                            <input type="email" class="form-control" id="shop_email" name="shop_email">
                        </div>
                        <div class="mb-3">
                            <label for="shop_password" class="form-label">店家密碼<span style="color:red;font-size:14px;">*必填</span><i class="fa-solid fa-eye-slash" id="eye"></i></label>
                            <input type="password" class="form-control" id="shop_password" name="shop_password">
                        </div>
                        <div class="mb-3">
                            <label for="shop_name" class="form-label">店家名稱<span style="color:red;font-size:14px;">*必填</span></label>
                            <input type="text" class="form-control" id="shop_name" name="shop_name">
                        </div>
                        <div class="mb-3">
                            <label for="shop_phone" class="form-label">店家電話<span style="color:red;font-size:14px;">*必填</span></label>
                            <input type="text" class="form-control" id="shop_phone" name="shop_phone">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">店家地址<span style="color:red;font-size:14px;">*必填</span></label>
                            <select id="selectcity" name="shop_address_city"></select>
                            <select id="selectarea" name="shop_address_area"></select>
                            <input type="text" class="form-control" id="address" name="shop_address_detail">
                        </div>
                        <div class="mb-3 d-flex">
                            <label for="shop_opentime" class="form-label">開店時間<span style="color:red;font-size:12px;">*必填</span></label><br>
                            <select name="shop_opentime" id="shop_opentime">
                                <?php for ($i = 5; $i <= 12; $i++) : ?>
                                    <option value="<?= sprintf("%'.02d", $i) ?>:00"><?= sprintf("%'.02d", $i) ?>:00</option>
                                <?php endfor; ?>
                            </select>

                            <label for="shop_closetime" class="form-label">關店時間<span style="color:red;font-size:12px;">*必填</span></label><br>
                            <select name="shop_closetime" id="shop_closetime">
                                <?php for ($i = 13; $i <= 24; $i++) : ?>
                                    <option value="<?= sprintf("%'.02d", $i) ?>:00"><?= sprintf("%'.02d", $i) ?>:00</option>
                                <?php endfor; ?>
                            </select>

                            <label for="shop_deadline" class="form-label">取餐截止時間<span style="color:red;font-size:12px;">*必填</span></label>
                            <select name="shop_deadline" id="shop_deadline">
                                <?php for ($i = 13; $i <= 24; $i++) : ?>
                                    <option value="<?= sprintf("%'.02d", $i) ?>:00"><?= sprintf("%'.02d", $i) ?>:30</option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <input type="hidden" class="form-control" id="shop_approved" name="shop_approved" value="0">
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="shop_terms" name="shop_terms" value="yes">
                            <label class="form-check-label" for="shop_terms">我已閱讀並同意<a href="#">惜食店家條款</a></label>
                        </div>
                        <button type="submit" class="btn btn-primary">送出</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include __DIR__ . '/parts/scripts.php'; ?>
<script src="./03-address.js"></script>

<script>
    let img = document.querySelector("#shop_img");
    let cover = document.querySelector("#shop_cover");

    cover.addEventListener("change", (evt) => {
        const file = evt.target.files[0];
        img.src = URL.createObjectURL(file);
    })

    let theeye = document.querySelector("#eye");
    theeye.addEventListener("click", () => {
        let t = document.querySelector("#shop_password");
        // console.log(t);
        let tvalue = t.getAttribute("type");
        // console.log(tvalue);
        if (tvalue == "password") {
            t.setAttribute("type", "text");
            theeye.classList.remove("fa-eye-slash");
            theeye.classList.add("fa-eye");
        } else {
            t.setAttribute("type", "password");
            theeye.classList.remove("fa-eye");
            theeye.classList.add("fa-eye-slash");
        }
    })

    let selCity = document.querySelector("#selectcity");
    let selArea = document.querySelector("#selectarea");

    ADDRESS.forEach((value, index, array) => {
        let {
            CityName
        } = value;

        selCity[index] = new Option(CityName, CityName);

    })

    selCity.addEventListener("change", (evt) => {
        selArea.options.length = 0;
        let city = selCity.options[selCity.selectedIndex].value;
        let area = ADDRESS.filter((value, index, array) => {
            return value.CityName === city;
        })

        area[0].AreaList.forEach((value, index, array) => {
            let {
                AreaName
            } = value;
            selArea[index] = new Option(AreaName, AreaName);
        })

    })

    function checkForm() {
        const fd = new FormData(document.form1);

        if (!shop_terms.checked) {
            alert('請勾選[同意店家條款]');
            return false;
        }

        fetch('03-u-shop-insert-api.php', {
            method: 'POST',
            body: fd
        }).then(r => r.json()).then(obj => {
            console.log(obj);
            if (!obj.success) {
                alert(obj.error);
            } else {
                alert('註冊成功')
                location.href = 'basepage-no-admin.php';
            }
        })

    }
</script>
<?php include __DIR__ . '/parts/html-foot.php'; ?>