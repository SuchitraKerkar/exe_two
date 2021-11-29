<?php
require_once('config.php');

$select="update users set deleted=1 where userid=".$_REQUEST['id']."";
$runsel=mysqli_query($conn,$select) or die('Error'.mysqli_error($conn));
    
	
	$datamsg="Data is Removed Successfully";
	echo $datamsg;
	
	
    header("Location:list_user.php");


?>