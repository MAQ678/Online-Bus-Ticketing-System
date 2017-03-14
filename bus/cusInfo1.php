<?php
//require "bus1.php";
require 'core.inc.php';
require 'Database/connect.php';
require 'SeatArray.php';


if(isset( $_SESSION['sign']))
	{
		if( $_SESSION['sign']==1)header('Location: adminMenu.php');
	}
	else header('Location: index.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Buy Page</title>
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
<h1>Give Your Opinion</h1>
<div  align="left"><a href="bus1.php">Back</a></div>

<div class="col-sm-4">
</div>
<div class="col-sm-4">

<?php
$vv=0;$rr=0;
	for($i=0;$i<count($sA);$i++)
	{
		if(isset($_POST[$sA[$i]]))
		{
			$_SESSION[$sA[$i]]=$_POST[$sA[$i]];
			$vv=1;
			$rr++;
		///	$rr=$_POST[$sA[$i]];
			//update index
		///	$q="UPDATE `busticket`.`seats` SET `booked_by`='2' where `seats`.`sno`='$rr'";
		///	$qr=mysql_query($q);
		///	$q="UPDATE `busticket`.`seats` SET `modified_by` = '$us' WHERE `seats`.`sno` = '$rr';";
		///	$qr=mysql_query($q);
		}
	}
	if($vv==0)
		echo "<div class='alert alert-danger'>You didn't select any.</div>";
	else
	{
		///header('Location: cusInfo1.php');
		$rw=0;
		$cid=$_SESSION['cuser_id'];
		$q="SELECT * from `seats` where `booked_by`='$cid' and (`available`='1' or `booked_time` is not NULL )";
		$qr=mysql_query($q);
		if($qr)
		$rw=mysql_num_rows($qr);

		if($rr+$rw>4)
		{
			for($i=0;$i<count($sA);$i++)
			{
				if(isset($_SESSION[$sA[$i]]))
					unset($_SESSION[$sA[$i]]);
			}
			echo "<div class='alert alert-danger'>Sorry you can buy atmost <strong>4 tickets</strong></div>";
		//<a href='bus1.php'>Go back to previous page</a>
		}
		else
		{
			$fair=$_SESSION['Fair'];
			echo"<p>Total fair will be <strong>".($fair*$rr)."</strong></p>";
			echo "<div class='form-group'>
			<form action='buytheticket.php' method='post' role='form'>
			<p>You want buy?</p>
			<input type='submit'  value='Buy' class='btn btn-info'>
			</form>
			</div>";
		}
	}
?>
</div>
<div class="col-sm-4">
</div>

</div>
</div>
</body>
</html>