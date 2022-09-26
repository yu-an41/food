<?php
if (!isset($_SESSION)) {
    session_start();
}

if (empty($_SESSION['shop'])) {
    header('Location: 03-u-shop-login-form.php');
    exit;
}
