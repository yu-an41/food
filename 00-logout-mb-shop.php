<?php

session_start();  // 啟用 session

if (!empty($_SESSION['member'])) {
    unset($_SESSION['member']);
}

if (!empty($_SESSION['shop'])) {
    unset($_SESSION['shop']);
}



header('Location: 00-basepage-no-admin.php');
