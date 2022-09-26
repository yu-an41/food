<?php require __DIR__ . '/parts/connect_db.php';
$pageName = 'edit';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
if (empty($sid)) {
    header('Location: 02-forum_list.php');
    exit;
}
$sql = " SELECT * FROM comment WHERE sid=$sid ";
$r = $pdo->query($sql)->fetch();
if (empty($r)) {
    header('Location: 02-forum_list.php');
    exit;
}
?>
<?php include __DIR__ . '/parts/html-head.php'; ?>


<table class="table table-striped table-bordered">
    <input type="hidden" name="sid" value="<?= $r['sid'] ?>">
    <input type="hidden" name="post_sid" value="<?= $r['post_sid'] ?>">
    <thead>
        <tr>

            <th scope="col"><?= $r['member_sid'] ?></th>


            <th scope="col"><?= $r['comment'] ?></th>

            <th scope="col"><?= $r['created_at'] ?></th>

        </tr>
    </thead>
    <?php include __DIR__ . '/parts/scripts.php'; ?>

    <?php include __DIR__ . '/parts/html-foot.php'; ?>