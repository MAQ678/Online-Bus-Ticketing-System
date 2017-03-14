<?php
require 'core.inc.php';
require 'Database/connect.php';
require 'SeatArray.php';


if(isset( $_SESSION['sign']))
	{
		if( $_SESSION['sign']==1)header('Location: adminMenu.php');
	}
	else header('Location: index.php');
	unset($_SESSION['from']);
		unset($_SESSION['to']);
		unset($_SESSION['dateT']);
		unset($_SESSION['type']);
$vv=0;
$cdt=date_default_timezone_get();
$cdt= date("Y-m-d H:i:s", strtotime($cdt . " +1 hour"));
$cid=$_SESSION['cuser_id'];
for($i=0;$i<count($sA);$i++)
	{
		if(isset($_SESSION[$sA[$i]]))
		{
					$vv=1;
					$rr=$_SESSION[$sA[$i]];

					$q="UPDATE `busticket`.`seats` SET `booked_by`='$cid' where `seats`.`sno`='$rr'";
					$qr=mysql_query($q);
					$q="UPDATE `busticket`.`seats` SET `booked_time`='$cdt' where `seats`.`sno`='$rr'";
					$qr=mysql_query($q);
					//unset($_SESSION[$sA[$i]]);
		}
	}
if($vv==0)
	{
		header('location: bus1.php');
	}
	//get current time of server
	
	

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
<h1>Hurrah</h1>
<div class="col-sm-4">
</div>
<div class="col-sm-4">
<p>Your ticker has been booked and send taka through bkash to our number within 1 hour</p>
<p>Your id is your mobile no</p>
<a href="cusMenu.php">Menu</a>
</div>

<div class="col-sm-4">
</div>

</div>
</div>
</body>
</html>