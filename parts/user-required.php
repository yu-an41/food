<?php
if(! isset($_SESSION)){
    session_start();
}

if(empty($_SESSION['shop'])){
    header('Location: 00-login-form-admin.php');
    exit;
}