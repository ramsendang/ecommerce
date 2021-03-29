<?php

session_start();
session_unset($_SESSION['ADMIN_LOGIN']='yes');
session_unset($_SESSION['ADMIN_LOGIN']='username');
header("location: index.php");

?>