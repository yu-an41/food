<?php include __DIR__ . '/parts/connect_db.php';

$sid_c = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

$sql_c = "DELETE FROM comment WHERE sid = {$sid_c}";

$pdo->query($sql_c);

$come_from_c = '02-comment_list.php';
if (!empty($_SERVER['HTTP_REFERER'])) {
    $come_from_c = $_SERVER['HTTP_REFERER'];
}
header("Location: {$come_from_c}");
