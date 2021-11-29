<!DOCTYPE html>
<html lang="en">
<head>
  <title>User Listing</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<br><br>
 <form form action="list_user.php" method="post">
<div class="container">
  <h2>Users Listing</h2> <br><br>

     <a href="add_user.php" class="btn btn-info btn-lg">
     <span class="glyphicon glyphicon-plus"></span>  
        </a>
		
		<div style="float:right;">
		<input type='text' id='name' name='name'>
		<input type="submit" class="btn btn-primary" name="Search" value="Search">
	    </div>
		
<br><br>  
  <table class="table table-bordered">
    <thead>
      <tr class="info">
        <th>Sr No</th>
        <th>Name</th>
        <th>Email</th>
		<th>Tel</th>
		<th>Gender</th>
		<th>Image</th>
		<th>Details</th>
		<th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
	  require_once('config.php');
	  
	  // echo"<pre>";
	//  print_r($_REQUEST); 
	  $nm="";
	  
	
	  if(isset($_REQUEST['Search']) && $_REQUEST['Search']!='')
	  {
		  if($_REQUEST['name']!='')
		  {
		  $nm=" and user_name='".$_REQUEST['name']."'";
		  }
	  } 
	  $select="select userid,user_name,email,phone,image,gender,details from users where deleted=0".$nm;
	  $runsel=mysqli_query($conn,$select);
	 // $numrows=mysqli_num_rows($runsel);
	  $i=0;
	  $table='';
	  while($result=mysqli_fetch_array($runsel))
	  {
		  $i++;
		  $table.="<tr class='active'><td>".$i."</td><td>".$result['user_name']."</td><td>".$result['email']."</td><td>".$result['phone']."</td><td>".$result['gender']."</td><td><image src='Upload/".$result['image']."' height='70px';></td><td>".$result['details']."</td>
		  <td>
		  &nbsp;&nbsp;<a href='user_update.php?id=".$result['userid']."'>
          <span class='glyphicon glyphicon-pencil'></span></a>
		  &nbsp;&nbsp;
		  <a href='user_delete.php?id=".$result['userid']."'>
          <span class='glyphicon glyphicon-remove'></span></a>
		
		</td>
		  </tr>";
	  }
	  if($i==0)
	  {
		   $table.="
		   <tr class='active'>
		    <td>No Records</td>
		  </tr>";
	  }
	  
	  echo $table;
	  
	  
	  ?>
    </tbody>
  </table>
</div>
</form>
</body>
</html>
