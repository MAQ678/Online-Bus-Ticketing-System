<?php
require 'core.inc.php';
require 'Database/connect.php';
if(isset( $_SESSION['sign']))
	{
		if( $_SESSION['sign']==1)header('Location: adminMenu.php');
	}
	else header('Location: index.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
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
<h1>Customer Menu</h1>
<div  align="right"><a href="logout.php">Sign Out</a></div>
<div class="col-sm-4">

</div>
<div class="col-sm-4">
<div class="well"> <a href="buyFair.php">Buy Ticket</a> </div>
<div class="well"><a href="ticketM.php">Tickets</a></div>

</div>

<div class="col-sm-4">

</div>

</div>
</div>
</body>
</html>