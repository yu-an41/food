<?php
if(! isset($_SESSION)){
    session_start();
}

if(empty($_SESSION['admin'])){
    header('Location: 00-login-form-admin.php');
    exit;
}
