<?php
session_start();

unset($_SESSION['shop']);

header('Location: basepage-no-admin.php');
