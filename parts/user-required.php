<?php
if(! isset($_SESSION)){
    session_start();
}

if(empty($_SESSION['shop'])){
    header('Location: login-form-admin.php');
    exit;
}