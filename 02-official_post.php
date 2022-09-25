<?php require __DIR__ . '/parts/connect_db.php';
$pageName = 'post';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
if (empty($sid)) {
    header('Location: 02-forum_card.php');
    exit;
}
$sql = " SELECT * FROM official_post WHERE sid=$sid ";
$r = $pdo->query($sql)->fetch();
if (empty($r)) {
    header('Location: 02-forum_card.php');
    exit;
}
?>
<?php include __DIR__ . '/parts/html-head.php'; ?>
<?php include __DIR__ . '/parts/nav-bar-no-admin.php'; ?>
<div class="container">
    <div class="row">
        <div class="mb-5 m-auto">
            <div class="card-body mb-5">
                <input type="hidden" name="sid" value="<?= $r['sid'] ?>">
                <div class="mb-5">
                    <h5 class="card-title" id="title" name="title" type="text"><?= $r['title'] ?></h5>
                    <img id="img_div" name="img_div" style="weight:300px;" src="./uploads/<?= $r['img'] ?>">
                    <div id="content" name="content"><?= $r['content'] ?> </div>
                </div>
                <div class="mb-3">
                    <h3 for="content" class="form-label mb-3">留言</h3>
                    <form name="form1" onsubmit="checkForm(); return false;" novalidate>
                        <textarea class="form-control" id="content" name="content" rows="3"></textarea>
                        <div id="contentHelp" class="form-text">100字以內</div>
                </div>
                <button type="button" id="btnComment" class="btn btn-primary">留言</button>
                </form>
            </div>

        </div>
    </div>
</div>

<?php include __DIR__ . '/parts/scripts.php'; ?>
<script>
    let cBtn = document.querySelector("#btnComment");
    cBtn.addEventListener("click", function() {

        const fd = new FormData(document.form1);

        for (let k of fd.keys()) {
            console.log(`${k}: ${fd.get(k)}`);
        }

        fetch('02-comment_api.php', {
            method: 'POST',
            body: fd
        }).then(r => r.json()).then(obj => {
            console.log(obj);
            if (!obj.success) {
                alert(obj.error);
            } else {
                alert('成功留言')
                location.href = '02-official_post.php';
            }
        })
    })
</script>
<?php include __DIR__ . '/parts/html-foot.php'; ?>