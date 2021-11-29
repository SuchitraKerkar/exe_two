<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-3">
<br><br>
  <h2>Login Page</h2>
  
  <form action="login.php" method="post">
  
  
    <div class="mb-3 mt-3">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" style="width:300px;">
    </div>
	
    <div class="mb-3">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd" style="width:300px;">
    </div>
	
	
	
    <div class="form-check mb-3">
      <label class="form-check-label">
        <input class="form-check-input" type="checkbox" name="remember"> Remember me
      </label>
    </div>

    <input type="submit" class="btn btn-primary" name="submit" value="Login">
	<input type="button" class="btn btn-secondary" value="cancel" name="cancel">
  </form>
</div>

</body>
</html>
<?php
require_once('config.php');

if(isset($_POST['email']) && isset($_POST['pswd']) && trim($_POST['email'])!='' && trim($_POST['pswd'])!='')
{
$psd=md5($_POST['pswd']);
$email=$_POST['email'];

$select="select userid from users where password='".addslashes($psd)."' and email='".addslashes($email)."' and deleted=0";
$runsel=mysqli_query($conn,$select) or die('Error'.mysqli_error($conn));
$num_rows=mysqli_num_rows($runsel);
if($num_rows==0)
{
	echo "Please enter valid email and Password";
	
}
else
{
	$result=mysqli_fetch_array($runsel);
	$_SESSION['valid_user']=$result['userid'];
	header("Location:index.php");
	
}
} 
?>
