<?php
	require 'core.inc.php';
	require 'Database/connect.php';

	if(isset( $_SESSION['sign']))
	{
		if( $_SESSION['sign']==1)header('Location: adminMenu.php');
	}
	else header('Location: index.php');

	
	/*if(isset($_SESSION['sms']))
	{
		echo $_SESSION['sms'];
		unset($_SESSION['sms']);
	}*/
?>

<!DOCTYPE html>
<html>
<head>
	<title>fair</title>
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
<h1>Give Your Information</h1>
<div  align="left"><a href="cusMenu.php">Back</a></div>

<div class="col-sm-4">
</div>
<div class="col-sm-4">

<form action="busSearch.php" method="post" role="form">
	<div class="form-group">
			<label for="from">From: </label>
			<input id="from" name="from" placeholder="Source" class="form-control"/>
	</div>

	<div class="form-group">
			<label for="to">To: </label>
			<input id="to" name="to" placeholder="Destination" class="form-control"/>
	</div>

	<div class="form-group">
			<label for="dateT">Date: </label>
			<input id="dateT" name="dateT" placeholder="YYYY-MM-DD" class="form-control"/>
	</div>

	<div class="form-group">
			<label for="type">Type: </label>
			<input type="radio" name="type" id="type" value="AC"> AC
			<input type="radio" name="type" id="type" value="nAC"> Non AC
	</div>

	<div class="form-group">
			<input type="submit" value="Go!" class="btn btn-info"/>
	</div>

	
</form>
</div>

<div class="col-sm-4">
</div>

</div>
</div>

</body>
</html>