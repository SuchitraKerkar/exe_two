<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add New User</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-3">
<br><br>
  <h2>Add New User</h2>
  
  <form action="add_user.php" method="post" enctype="multipart/form-data">
  
  
   <div class="mb-3 mt-3">
      <label for="name">Name:</label>
      <input type="name" class="form-control" id="name" placeholder="Enter Name" name="name">
    </div>
	
	
    <div class="mb-3 mt-3">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
    </div>
	
    <div class="mb-3">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd">
    </div>
	
	  <div class="mb-3">
      <label for="phone">Phone:</label>
      <input type="tel" class="form-control" id="phone" placeholder="Enter phone" name="phone">
    </div>
	
	 <div class="mb-3">
	 <div class="form-check form-check-inline">
	  <input class="form-check-input" type="radio" name="gender" id="m" value="M">
	  <label class="form-check-label" for="M">M</label>
	</div>
	<div class="form-check form-check-inline">
	  <input class="form-check-input" type="radio" name="gender" id="f" value="F">
	  <label class="form-check-label" for="F">F</label>
	</div>
</div>
	
	  <div class="mb-3">
      <label for="file">Attach:</label>
      <input class="form-control" type="file" id="formFile" name="attachfile">
      </div>
	  
	  <div class="mb-3">
      <label for="file">User Details:</label>
      <textarea class="form-control"  id="details" name="details" col="30" rows="3"></textarea>
      </div>
	
    <!--div class="form-check mb-3">
      <label class="form-check-label">
        <input class="form-check-input" type="checkbox" name="remember"> Remember me
      </label>
    </div-->

    <input type="submit" class="btn btn-primary" name="submit"/>
	<input type="button" class="btn btn-secondary" value="cancel" name="cancel"/>
  </form>
</div>

</body>
</html>

<?php
require_once("config.php");

if(isset($_POST['submit']))
{


$array_mandatory=array('Name'=>'name','Email'=>'email','Password'=>'pswd','Phone'=>'phone','Gender'=>'gender','Details'=>'details');

$mesg='';

$table="<table class='table table-bordered'>
    <thead>
      <tr>
        <th>Mandatory fields Missing in the form</th>
      </tr>
    </thead>
    <tbody>
      ";

foreach($array_mandatory as $v => $k)
{
	
	
	if($_POST[$k]=="" && isset($_POST[$k]))
	{
		$mesg.="<tr>".$v."<tr>";
	} 
	
} 

$table.="</tbody></table>";
$datamsg='';


 if(is_array($_FILES)) 
 {
	  $fileName = $_FILES['attachfile']['tmp_name'];
	  $image = $_FILES['attachfile']['name'];
        
	
 }

if($mesg!='')
{
 echo $table;
} 

$encrypted_pwd = md5($_POST['pswd']);

$select="select userid from users where user_name='".addslashes($_POST['name'])."'";
$run_select=mysqli_query($conn,$select) or die('Error 1'.mysqli_error($conn));
$num=mysqli_num_rows($run_select);

if($num>=1)
{
	$datamsg="Data is already available for user";
	echo $datamsg;
	exit();
}
else
{
	$insert="insert into users(user_name,password,email,phone,gender,details,image) values('".addslashes($_POST['name'])."','".addslashes($encrypted_pwd)."','".addslashes($_POST['email'])."','".$_POST['phone']."','".$_POST['gender']."','".addslashes($_POST['details'])."','".addslashes($image)."')";
	$run_insert=mysqli_query($conn,$insert) or die('Error 1'.mysqli_error($conn));
	$datamsg="Data is inserted Successfully";
	move_uploaded_file($fileName,"Upload/$image");
	echo $datamsg;
}



}
 


?>