<?php
require __DIR__ . '/parts/admin-required.php';
require __DIR__ . '/parts/connect_db.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login-form-admin.php');
}
$pageName = 'orderEdit';

$o_sid = isset($_GET['order_sid']) ? intval($_GET['order_sid']) : 0;
if (empty($o_sid)) {
    header('Location: 01-order-history-admin.php');
    exit;
}

$sql = "SELECT * FROM `order-history` WHERE `order_sid` = $o_sid";
$r = $pdo->query($sql)->fetch();

if (empty($r)) {
    header('Location: 01-oder-history-admin.php');
    exit;
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
        <div class="col-md-8 col-lg-6 m-auto">
            <div class="card">
                <div class="card-body">
                    <form name="formEdit" onsubmit="checkForm(); return false;" novalidation>
                        <input type="hidden" name="orderSid" value="<?= $r['order_sid'] ?>">
                        <div class="mb-3">
                            <label for="orderNum" class="form-label">Order Number</label>
                            <input type="text" name="orderNum" class="form-control" id="orderNum" value="<?= $r['order_num'] ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="prdouctSid" class="form-label">Member Sid</label>
                            <input type="text" class="form-control" id="memberSid" name="memberSid" value="<?= $r['member_sid'] ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="createdTime" class="form-label">Created At</label>
                            <input type="text" class="form-control" id="createdTime" name="createdTime" value="<?= $r['created_at'] ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="total" class="form-label">Total</label>
                            <input type="text" class="form-control" name="total" value="<?= $r['total'] ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="orderStatus" class="form-label">Order Status</label>
                            <select class="form-select" name="orderStatus" id="orderStatus">
                                <option <?= $r['order_status'] == '已付款' ? 'selected' : '' ?> value="已付款">已付款</option>
                                <option <?= $r['order_status'] == '已取貨' ? 'selected' : '' ?> value="已取貨">已取貨</option>
                                <option <?= $r['order_status'] == '退款申請中' ? 'selected' : '' ?> value="退款申請中">退款申請中</option>
                                <option <?= $r['order_status'] == '已退款' ? 'selected' : '' ?> value="已退款">已退款</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include __DIR__ . '/parts/scripts.php'; ?>
<script>
    function checkForm() {
        const fd = new FormData(document.formEdit);

        for (let k of fd.keys()) {
            console.log(`${k}: ${fd.get(k)}`);
        }

        fetch('01-edit-api.php', {
                method: 'POST',
                body: fd,
            })
            .then(r => r.json())
            .then(obj => {
                console.log(obj);
                if (!obj.success) {
                    alert(obj.error);
                } else {
                    alert('訂單狀態修改成功！');
                }
            })
    }
</script>
<?php
include __DIR__ . '/parts/html-foot.php'; ?>