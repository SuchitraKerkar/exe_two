<?php
session_start();
require_once('config.php');
session_destroy();
	header("Location:login.php");
 

 //print_r($_SESSION['valid_user']);
?>