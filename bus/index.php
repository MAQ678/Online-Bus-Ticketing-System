<?php
require 'core.inc.php';
if(isset( $_SESSION['sign']))
{
	if( $_SESSION['sign']==2)
	{
		header('Location: cusMenu.php');
	}
	else if( $_SESSION['sign']==1)header('Location: adminMenu.php');
	else header('Location: logout.php');
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Online Bus ticketing System</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet"  href="css/front.css"/>
	<!-- bootstrap starts here -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
	<script src="script/bootstrap/bootstrap_min.js"></script>
	<script src="script/bootstrap/jquery_min.js"></script>

	<!-- bootstrap ends here -->
	<link rel="stylesheet" href="css/backO.css"/>
</head>


<body>

<div class="oPu">


<div class="container">
<div class="header">
  <div class="jumbotron">
<h2 ><strong>Welcome to Online Bus ticketing system</strong></h2>
</div>
</div>
<div class="col-lg-12 text-center">

<div class="section">
<h2>New to this site?</h2>
<a href="signup.php">Sign up</a>
<br>
<h2>Already have an account?!</h2>
<a href="cus_sign_in.php">Sign in</a>
</div>

<div class="panel panel-default">
<div class="panel-footer">
<a href="adminLogin.php">Admin login</a>
</div>
</div>


</div>
</div>



</div>
</body>
</html>