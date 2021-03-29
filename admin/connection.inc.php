<?php
session_start();
$conn = mysqli_connect("localhost","root","","ecommerce");

define('SERVER_PATH', $_SERVER['DOCUMENT_ROOT'].'/ecommerce/');
define('SITE_PATH', 'https://127.0.0.1/ecommerce/');

define('PRODUCT_IMAGE_SERVER_PATH', SERVER_PATH.'media/product/');
define('PRODUCT_IMAGE_SITE_PATH', SITE_PATH.'media/product/');
?>