<?php
require __DIR__ . '/parts/connect_db.php';

$perPage = 2; #一頁有幾筆
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$t_sql = "SELECT COUNT(1) FROM event_test_1 ";
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];

$totalPages = ceil($totalRows / $perPage);

$rows = [];
//如果有資料
if ($totalRows) {
    if ($page < 1) {
        header('Location: ?=1'); //等於('Location:list.php')
        exit;
    }
    if ($page > $totalPages) {
        header('Location: ?=' . $totalPages);
    }
    $sql = sprintf(
        "SELECT * FROM event_test_1 ORDER BY sid LIMIT %s, %s",
        ($page - 1) * $perPage,
        $perPage
    );
    $rows = $pdo->query($sql)->fetchAll();
}


$output = [
    'totalRows' => $totalRows,
    'totalPages' => $totalPages,
    'page' => $page,
    'rows' => $rows,
];

header('Content-Type: application/json');
echo json_encode($output);exit;
?>