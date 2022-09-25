<?php
require __DIR__ . '/parts/connect_db.php';
$pageName = 'insert';

?>

<?php include __DIR__ . '/parts/html-head.php'; ?>
<?php include __DIR__ . '/parts/nav-bar-admin.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">新增資料</h5>
                    <img src="" alt="" id="event_img" style="width: 300px;">
                    <form name="form1" onsubmit="checkForm(); return false;">
                        <div class="mb-3">
                            <label for="images" class="form-label">圖片</label>
                            <input type="file" class="form-control" id="images" name="images">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">名稱</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">活動說明</label>
                            <textarea class="form-control" name="content" id="content" cols="30" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">地點</label>
                            <input type="text" class="form-control" id="location" name="location">
                        </div>
                        <div class="mb-3">
                            <label for="tags" class="form-label">標籤</label>
                            <input type="text" class="form-control" id="tags" name="tags">
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label">活動日期</label>
                            <input type="datetime-local" class="form-control" id="date" name="date">
                        </div>
                        <div class="mb-3">
                            <label for="restricted_maximum" class="form-label">人數限制</label>
                            <input type="text" class="form-control" id="restricted_maximum" name="restricted_maximum">
                        </div>
                        <div class="mb-3">
                            <label for="host" class="form-label">主辦單位</label>
                            <input type="text" class="form-control" id="host" name="host">
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">票價</label>
                            <input type="text" class="form-control" id="price" name="price">
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
    let img = document.querySelector("#event_img");
    let cover = document.querySelector("#images");

    cover.addEventListener("change", (evt) => {
        const file = evt.target.files[0];
        img.src = URL.createObjectURL(file);
    })


    function checkForm() {
        //document.form1
        const fd = new FormData(document.form1);
        for (let k of fd.keys()) {
            console.log(`${k}:${fd.get(k)}`);
        }
        fetch('06-insert-api.php', {
            method: 'POST',
            body: fd
        }).then(r => r.json()).then(obj => {
            console.log(obj);
            if (!obj.success) {
                alert(obj.error);
            } else {
                alert('新增成功')
                location.href = '06-list.php';
            }
        })
    }
</script>
<?php include __DIR__ . '/parts/html-foot.php'; ?>