<?php
 require_once('config.php');

$select="select userid,user_name,email,phone,image,gender,details from users where userid=".$_REQUEST['id']."";
$runsel=mysqli_query($conn,$select) or die('Error'.mysqli_error($conn));
while($result=mysqli_fetch_array($runsel))
{
    $name=$result['user_name'];
	$userid=$result['userid'];
	$email=$result['email'];
	$phone=$result['phone'];
	$image="upload/".$result['image'];
	$img=$result['image'];
	$gender=$result['gender'];
	$details=$result['details'];
	$check1='';
	$check2='';
	if($gender=='M')
	{
		$check1='checked';
	}
	if($gender=='F')
	{
		$check2='checked';
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Update User</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-3">
<br><br>
  <h2>Update User Details</h2>
  
  <form action="user_update.php?id=<?php echo $userid;?>" method="post" enctype="multipart/form-data">
  
  
   <div class="mb-3 mt-3">
      <label for="name">Name:</label>
	  <?php echo $name;?>
	  <input type='hidden' id='id' name='id' value='<?php echo $userid;?>'>
	</div>
	
	
    <div class="mb-3 mt-3">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="<?php echo $email;?>">
    </div>
	
  
	  <div class="mb-3">
      <label for="phone">Phone:</label>
      <input type="tel" class="form-control" id="phone" placeholder="Enter phone" name="phone" value="<?php echo $phone;?>">
    </div>
	
	 <div class="mb-3">
	 <div class="form-check form-check-inline">
	  <input class="form-check-input" type="radio" name="gender" id="m" value="M" <?php echo $check1;?>>
	  <label class="form-check-label" for="M">M</label>
	</div>
	<div class="form-check form-check-inline">
	  <input class="form-check-input" type="radio" name="gender" id="f" value="F"<?php echo $check2;?>>
	  <label class="form-check-label" for="F">F</label>
	</div>
</div>
	
	  <div class="mb-3">
      <label for="file">Attach:</label>
	  <img src="<?php echo $image;?>" height="60px";/>
	  <input type='hidden' id='img1' name='img1' value='<?php echo $img;?>'>
      <input class="form-control" type="file" id="formFile" name="attachfile">
      </div>
	  
	  <div class="mb-3">
      <label for="file">User Details:</label>
      <textarea class="form-control"  id="details" name="details" col="30" rows="3"><?php echo $details;?></textarea>
      </div>
	
    <!--div class="form-check mb-3">
      <label class="form-check-label">
        <input class="form-check-input" type="checkbox" name="remember"> Remember me
      </label>
    </div-->

    <input type="submit" class="btn btn-primary" name="Update" value="update"/>
	<input type="button" class="btn btn-secondary" value="cancel" name="cancel"/>
  </form>
</div>

</body>
</html>

<?php
require_once("config.php");

if(isset($_POST['Update']))
{


$array_mandatory=array('Email'=>'email','Phone'=>'phone','Gender'=>'gender','Details'=>'details');

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
$k=0;

 if(is_array($_FILES)) 
 {
	
	$fileName = $_FILES['attachfile']['tmp_name'];
	$image = $_FILES['attachfile']['name'];
       
	if($fileName=='')
	{
		 $image = $_POST['img1'];
	}
 }

 

if($mesg!='')
{
 echo $table;
} 




	$update="update users set email='".addslashes($_POST['email'])."',phone='".addslashes($_POST['phone'])."',gender='".$_POST['gender']."',details='".$_POST['details']."',image='".addslashes($image)."' where userid='".$_POST['id']."'";
	$update_insert=mysqli_query($conn,$update) or die('Error 1'.mysqli_error($conn));
	
	if($k>=1)
	{
	move_uploaded_file($fileName,"Upload/$image");
	}
	$datamsg="Data is Updated Successfully";
	echo $datamsg;
	
	
    header("Location:list_user.php");



}
 
 

?>