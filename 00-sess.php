<?php
session_start();

foreach ($_SESSION['cart'] as $k => $v){
    echo json_encode($v['product_sid']);
}



// echo json_encode($_SESSION);
