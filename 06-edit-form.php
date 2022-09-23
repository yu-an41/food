<?php include __DIR__ . '/parts/connect_db.php';
$pageName = 'edit';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
if (empty($sid)) {
    header('Location: 06-list.php');
    exit;
}

$sql = "SELECT * FROM `event_test_1` WHERE sid=$sid";
$r = $pdo->query($sql)->fetch();
if (empty($r)) {
    header('Location: 06-list.php');
    exit;
}


?>

<?php include __DIR__ . '/parts/html-head.php'; ?>
<?php include __DIR__ . '/parts/nav-bar-admin.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">修改資料</h5>
                    <img src="./uploads/<?= $r['images'] ?>" alt="" id="event_img" style="width: 300px;">
                    <form name="form1" onsubmit="checkForm(); return false;">
                        <input type="hidden" name="sid" value="<?= $r['sid'] ?>">
                        <div class="mb-3">
                            <label for="images" class="form-label">圖片</label>
                            <input type="file" class="form-control" id="images" name="images">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">名稱</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= $r['name'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">活動說明</label>
                            <textarea class="form-control" name="content" id="content" cols="30" rows="3"><?= $r['content'] ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">地點</label>
                            <input type="text" class="form-control" id="location" name="location" value="<?= $r['location'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="tags" class="form-label">標籤</label>
                            <input type="text" class="form-control" id="tags" name="tags" value="<?= $r['tags'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label">活動日期</label>
                            <input type="datetime-local" class="form-control" id="date" name="date" value="<?= $r['date'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="restricted_maximum" class="form-label">人數限制</label>
                            <input type="text" class="form-control" id="restricted_maximum" name="restricted_maximum" value="<?= $r['restricted_maximum'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="host" class="form-label">主辦單位</label>
                            <input type="text" class="form-control" id="host" name="host" value="<?= $r['host'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">票價</label>
                            <input type="text" class="form-control" id="price" name="price" value="<?= $r['price'] ?>">
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
        fetch('06-edit-api.php', {
            method: 'POST',
            body: fd
        }).then(r => r.json()).then(obj => {
            console.log(obj);
            if (!obj.success) {
                alert(obj.error);
            } else {
                alert('修改成功')
                location.href = '06-list.php';
            }
        })
    }
</script>
<?php include __DIR__ . '/parts/html-foot.php'; ?>