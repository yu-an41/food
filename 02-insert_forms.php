<?php 
require __DIR__ . '/parts/admin-required.php';
require __DIR__ . '/parts/connect_db.php';

$pageName = 'insert';
?>
<?php include __DIR__ . '/parts/html-head.php'; ?>
<?php include __DIR__ . '/parts/nav-bar-admin.php'; ?>
<div class="container ">
    <div class="row ">
        <div class="col-lg-6 m-auto mt-5">
            <div class="card ">
                <div class="card-body ">
                    <h5 class="card-title">新增文章</h5>
                    <form name="form1" onsubmit="checkForm(); return false;" novalidate>
                        <div class="mb-3">
                            <label for="title" class="form-label">標題</label>
                            <input type="text" class="form-control" id="title" name="title">
                            <div id="titleHelp" class="form-text">(必填)20字以內</div>
                        </div>
                        <img id="img_div" name="img_div" style="height:200px;">
                        <div class="mb-3">
                            <label for="img" class="form-label">圖片</label>
                            <input class="form-control" type="file" id="img" name="img" multiple>
                            <div id="imgHelp" class="form-text">(必填)一至五張</div>
                        </div>
                        <!-- <div class="mb-3">
                            <label for="video" class="form-label">影片</label>
                            <input type="file" class="form-control" id="video" name="video">
                            <div id="videoHelp" class="form-text">限1部10MB內影片</div>
                        </div> -->
                        <div class="mb-3">
                            <label for="content" class="form-label">內文</label>
                            <textarea class="form-control" id="content" name="content" rows="3"></textarea>
                            <div id="contentHelp" class="form-text">(必填)500字以內</div>
                        </div>
                        <div class="mb-3">
                            <label for="hashtag" class="form-label">標籤</label>
                            <textarea class="form-control" id="hashtag" name="hashtag" rows="3"></textarea>
                            <div id="hashtagHelp" class="form-text">＃</div>
                        </div>
                        <button type="button" id="btn" class="btn btn-primary">送出</button>
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


    let btn = document.querySelector("#btn")
    btn.addEventListener("click", function() {
        //令form1的FormData＝fd
        const fd = new FormData(document.form1);

        fetch('02-insert_api.php', {
            method: 'POST',
            body: fd
        }).then(r => r.json()).then(obj => {
            console.log(obj);
            //把r轉成json格式
            if (!obj.success) {
                alert(obj.error);
            } else {
                alert('新增成功')
                location.href = '02-official_list.php';
            }
        })
    })

    // let files = document.querySelector('#img')
    // if (files.img.length < 1) {
    //     alert('最少新增一張圖片');
    // } else if (files.img.length > 5) {
    //     alert('最多新增五張圖片');
    //     return false;
    // }
</script>
<?php include __DIR__ . '/parts/html-foot.php'; ?>