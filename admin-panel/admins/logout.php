<?php 
session_start();
session_unset();
session_destroy();


require '../layout/header.php'; 
header("location:".ADMINURL."");
?>