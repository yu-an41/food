<?php
if(! isset($_SESSION)){
    session_start();
}

if(empty($_SESSION['admin'])){
    header('Location: login-form-admin.php');
    exit;
}