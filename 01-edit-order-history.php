<?php
require __DIR__ . '/parts/admin-required.php';
if (!isset($_SESSION['admin'])) {
    header('Location: login-form-admin.php');
}
$pageName = 'orderEdit';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
if (empty($sid)) {
    header('Location: 01-order-history-admin.php');
    exit;
}

$sql = "SELECT * FROM `order-history` WHERE order_sid = $sid";
$row = $pdo->query($sql)->fetch();

if (empty($row)) {
    header('Location: 01-oder-history-admin.php');
}
?>
<?php
include __DIR__ . '/parts/html-head.php'; ?>
<?php
include __DIR__ . '/parts/nav-bar-admin.php'; ?>
<div class="container">
    <div class="row">
        <h4 class="text-center mb-3">編輯訂單狀態
        </h4>
    </div>
    <div class="row">
        <div class="card">
            <div class="card-body">
                <form name="formEdit" onsubmit="checkForm(); return false;" novalidation>
                    <div class="mb-3">
                        <label for="orderNum" class="form-label">Order Number</label>
                        <input type="text" name="orderNum" class="form-control" id="orderNum">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include __DIR__ . '/parts/scripts.php'; ?>
<?php
include __DIR__ . '/parts/html-foot.php'; ?>