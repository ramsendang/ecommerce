<?php

session_start();
session_unset($_SESSION['USER_LOGIN']='yes');
session_unset($_SESSION['USER_ID']=$row['id']);
session_unset($_SESSION['USER_LOGIN']=$row['name']);
session_unset($_SESSION['cart']);
header("location: login.php");

?>