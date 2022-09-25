<?php
session_start();

unset($_SESSION['admin']);

header('Location: 00-basepage-admin.php');