<?php require __DIR__ . '/parts/connect_db.php';
$pageName = 'edit';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
if (empty($sid)) {
    header('Location: 02-official_list.php');
    exit;
}
$sql = " SELECT * FROM official_post WHERE sid=$sid ";
$r = $pdo->query($sql)->fetch();
if (empty($r)) {
    header('Location: 02-official_list.php');
    exit;
}
?>
<?php include __DIR__ . '/parts/html-head.php'; ?>
<?php include __DIR__ . '/parts/nav-bar-admin.php'; ?>
<div class="container ">
    <div class="row ">
        <div class="col-lg-6 m-auto mt-5">
            <div class="card ">
                <div class="card-body ">
                    <h5 class="card-title">修改資料</h5>
                    <form name="form1" onsubmit="checkForm(); return false;" novalidate>
                        <input type="hidden" name="sid" value="<?= $r['sid'] ?>">
                        <div class="mb-3">
                            <label for="title" class="form-label">標題</label>
                            <input type="text" class="form-control" id="title" name="title" required value="<?= htmlentities($r['title']) ?>">
                            <div id="titleHelp" class="form-text">(必填)20字以內</div>
                        </div>
                        <img id="img_div" name="img_div" style="height:200px;" src="./uploads/<?= $r['img'] ?>">
                        <div class="mb-3">
                            <label for="img" class="form-label">圖片</label>
                            <input class="form-control" type="file" id="img" name="img">
                            <div id="imgHelp" class="form-text">(必填)一至五張</div>
                        </div>
                        <!-- <div class="mb-3">
                            <label for="video" class="form-label">影片</label>
                            <input type="file" class="form-control" id="video" name="video">
                            <div id="videoHelp" class="form-text">限1部10MB內影片</div>
                        </div> -->
                        <div class="mb-3">
                            <label for="content" class="form-label">內文</label>
                            <textarea class="form-control" id="content" name="content" rows="3"><?= $r['content'] ?></textarea>
                            <div id="contentHelp" class="form-text">(必填)500字以內</div>
                        </div>
                        <div class="mb-3">
                            <label for="hashtag" class="form-label">標籤</label>
                            <textarea class="form-control" id="hashtag" name="hashtag" rows="3"><?= $r['hashtag'] ?></textarea>
                            <div id="hashtagHelp" class="form-text">＃</div>
                        </div>
                        <button type="button" id="btnEdit" class="btn btn-primary">送出</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/parts/scripts.php'; ?>
<script>
    let image = document.querySelector("#img_div");
    let img_table = document.querySelector("#img");

    img_table.addEventListener("change", (evt) => {
        const file = evt.target.files[0];
        image.src = URL.createObjectURL(file);
    })
    let eBtn = document.querySelector("#btnEdit");
    eBtn.addEventListener("click", function() {

        const fd = new FormData(document.form1);

        for (let k of fd.keys()) {
            console.log(`${k}: ${fd.get(k)}`);
        }

        fetch('02-edit_api.php', {
            method: 'POST',
            body: fd
        }).then(r => r.json()).then(obj => {
            console.log(obj);
            if (!obj.success) {
                alert(obj.error);
            } else {
                alert('修改成功')
                location.href = '02-official_list.php';
            }
        })
    })
</script>
<?php include __DIR__ . '/parts/html-foot.php'; ?>