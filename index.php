<?php
/* 
 */session_start();
 if(!isset($_SESSION['valid_user']))
 {
	header("Location:login.php");
 }

 //print_r($_SESSION['valid_user']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="list_user.php"><span class="glyphicon glyphicon-th-list"></span></a></li>
	  <li ><a href="add_user.php"><span class="glyphicon glyphicon-user"></span></a></li>
      <!--li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">Page 1-1</a></li>
          <li><a href="#">Page 1-2</a></li>
          <li><a href="#">Page 1-3</a></li>glyphicon glyphicon-user
        </ul>
      </li>
      <li><a href="#">Page 2</a></li-->
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#">
          <span class="glyphicon glyphicon-home"></span>
        </a></li>
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    </ul>
  </div>
</nav>
  
<div class="container">
  <h3>Home Page</h3>
  <p>Welcome to Home page</p>
</div>

</body>
</html>
