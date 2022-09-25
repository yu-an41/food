<?php require __DIR__ . '/parts/connect_db.php';
if (empty($_SESSION['admin'])) {
    header('Location: 02-forum_list.php');
}
?>
<?php include __DIR__ . '/parts/html-head.php'; ?>
<?php include __DIR__ . '/parts/nav-bar-admin.php'; ?>

<div class="container">
    <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">列表</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="comment-tab" data-bs-toggle="tab" data-bs-target="#comment-tab-pane" type="button" role="tab" aria-controls="comment-tab-pane" aria-selected="false">留言</button>
        </li>
    </ul>
    <div class="row mb-3">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                <?php
                include __DIR__ . '/02-official_list.php';
                ?>
            </div>
            <div class="tab-pane fade " id="comment-tab-pane" role="tabpanel" aria-labelledby="comment-tab" tabindex="0">
                <?php
                include __DIR__ . '/02-comment_list.php';
                ?>
            </div>
        </div>
    </div>
</div>


<?php include __DIR__ . '/parts/scripts.php'; ?>

<?php include __DIR__ . '/parts/html-foot.php'; ?>