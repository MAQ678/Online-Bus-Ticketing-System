<!-- php code starts here -->

<?php
require 'core.inc.php';
require 'Database/connect.php';
require 'SeatArray.php';
/*foreach ($_POST as $key => $value) {
	echo $key." ".$value."<br>";
*/
	if(isset( $_SESSION['sign']))
	{
		if( $_SESSION['sign']==1)header('Location: adminMenu.php');
	}
	else header('Location: index.php');
//echo "Note: You can only see the bus which will start after 1 houre of more.\n";
	if(isset($_POST['from'])&&isset($_POST['to'])&&isset($_POST['dateT'])&&isset($_POST['type']))
	{
		$_SESSION['from']=$_POST['from'];
		$_SESSION['to']=$_POST['to'];
		$_SESSION['dateT']=$_POST['dateT'];
		$_SESSION['type']=$_POST['type'];
	}

$sr=$_SESSION['from'];
$ds=$_SESSION['to'];
$dt=$_SESSION['dateT'];
$tp=$_SESSION['type'];


	if(isset($_POST['page']))
	{
		if(empty($_POST['page']))
		{
			echo "Please choose one of them.\n";
		}
		else
		{

			$_SESSION['sno']=$_POST['page'];
			header('location: bus1.php');
		}
	}
?>
<?php



// check availibity of these post variable later
$j=0;
$q="select * from `bus_t` where `source`='$sr' and `destination`='$ds' and `type`='$tp'";
$qr=mysql_query($q);
/*
if(!mysql_num_rows($qr))
{
	echo "No bus Available in this root<br>";
}*/
if(mysql_num_rows($qr))
{

	//get the value of fair
	$qq="select `fair` from `bus_fair` where `Source`='$sr' and `destination`='$ds' and `type`='$tp'";
	$qqr=mysql_query($qq);
	$fair=mysql_result($qqr, 0);
	$_SESSION['Fair']=$fair;
	//get the value of fair
	///echo "fair is ".$fair."\n";

	$n=mysql_num_rows($qr);
	//echo $n;
	for($i=0;$i<$n;$i++)
	{
		$z=mysql_result($qr,$i,'b_id');
		//echo $z;
		//$bid[$j++]=mysql_result($qr,$i,'b_id');
		//
		///echo $z."\n";
		$cda=date_default_timezone_get();//date("Y-m-d h:i:s");
		$cda= date("H:i:s", strtotime($cda . " +1 hour"));
		$cdtt=date_default_timezone_get();
		$cdtt= date("Y-m-d", strtotime($cdtt));
//CONCAT(`date`,`time`)>$cda
		$qqq="select * from `seats` where `bus_id`='$z' and `date`='$dt' and (`date`>'$cdtt' or (`date`='$cdtt' and `time`>'$cda')) and `booked_by`='1' and `available`='0' and `booked_time`is NULL";//edited
		$qqqr=mysql_query($qqq);
		$vv=mysql_num_rows($qqqr);
		//echo $vv;
		//echo $vv;
		if($vv!=0)
			{
				$bid[$j++]=$z;
			}
	}

}
if($j==0)echo "No bus Available in this root<br>";

?>
<!-- php ends here -->


<!DOCTYPE html>
<html>
<head>
	<title>Bus Search</title>
	<meta charset="utf-8"/>
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
<h1>Select your desired bus</h1>
<div  align="left"><a href="buyFair.php">Back</a></div>

<div class='alert alert-success'><strong>Note:</strong> You can only see the bus which will start after <strong>1 houre of more</strong>.</div>

<div class="col-sm-2">
</div>
<div class="col-sm-8">



<form action="<?php echo $current_site; ?>" method="post" role="form">
<table class="table table-striped">  <!-- bootstrap -->
<thead>
	
	<tr>
		<th><strong>Operator</strong>(Bus Type)</th>
		<th><strong>Dep. Time</strong></th>
		<th><strong>Seats Available</strong></th>
		<th><strong>Fare</strong></th>

	</tr>
	</thead>
	<tbody>
	<?php

	//for()
	

	for($i=0;$i<$j;$i++)
	{
		//name select
		$q="select `name` from `bus_t` where `b_id`='$bid[$i]'";
		$qr=mysql_query($q);
		$na=mysql_result($qr, 0);
		//name end

		$cda=date_default_timezone_get();//date("Y-m-d h:i:s");
		$cda= date("H:i:s", strtotime($cda . " +1 hour"));
		$cdtt=date_default_timezone_get();
		$cdtt= date("Y-m-d", strtotime($cdtt));
		//time select 
		$q="select DISTINCT  `time` from `seats` where `bus_id`='$bid[$i]' and `date`='$dt' and (`date`>'$cdtt' or (`date`='$cdtt' and `time`>'$cda'))";
		$qr=mysql_query($q);
		$tt=mysql_num_rows($qr);//total time
		for($k=0;$k<$tt;$k++)
		{
			$ct=mysql_result($qr,$k);//current time

			//number of seat count start
			$q="select * from `seats` where `booked_by`='1' and `bus_id`='$bid[$i]' and `date`='$dt' and `time`='$ct' and `available`='0'";//edited
			$nqr=mysql_query($q);
			$ts=mysql_num_rows($nqr);//total seat
			//number of seat count end
			$sno=mysql_result($nqr, 0,'sno');
			echo " 
			<tr align='left'>
				<td><input type='radio' name='page' id='page' value='$sno'> $na</td>
				<td>$ct</td>
				<td>$ts</td>
				<td>$fair</td>
			</tr>
				";

		}
		//time end
/*
		echo " 

			<tr>
				<td><input type='radio' name='page' id='page' value='$bid[$i]'> '$na'</td>
				<td>11.00</td>
				<td>12</td>
				<td>450</td>
			</tr>

		";

		<tr>
		<td><a href="bus1.php">Hanif</a></td>
		<td>11.00</td>
		<td>12</td>
		<td>450</td>
		</tr>
		*/
	}

	?>

	
	</tbody>

</table>
<div class="form-group">
<input type="submit" value="Go!" class="btn btn-info"/>
</div>

</form>

</div>
<div class="col-sm-2">
</div>

</div>
</div>
</body>
</html>