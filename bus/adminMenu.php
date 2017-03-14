<?php
	require 'core.inc.php';
	require 'checkLogin.php';
	if(isset( $_SESSION['sign']))
	{
		if( $_SESSION['sign']==2)header('Location: cusMenu.php');
	}
	else header('Location: index.php');

?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Menu</title>
	<!-- bootstrap starts here -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
	<script src="script/bootstrap/bootstrap_min.js"></script>
	<script src="script/bootstrap/jquery_min.js"></script>
	<!-- bootstrap ends here -->

</head>
<body>
<div class="container">
<div class="col-lg-12 text-center">
<h1>Admin Menu</h1>
<div  align="right"><a href="logout.php">Sign Out</a></div>
<div class="col-sm-4">

</div>
<div class="col-sm-4">

<div class="well"><a href="ABusRoot.php">Add a new root</a></div>
<div class="well"><a href="ABusAdd.php">Add a new bus</a></div>
<div class="well"><a href="AModSeat1.php">Modify of Check seats</a></div>
<div class="well"><a href="bookMenu.php">Booking Menu</a></div>

</div>

<div class="col-sm-4">

</div>

</div>
</div>

</body>
</html>