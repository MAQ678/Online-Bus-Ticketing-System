<!DOCTYPE html>

<?php

	require 'core.inc.php';
	require 'Database/connect.php';
	require 'checkLogin.php';

	if(isset( $_SESSION['sign']))
	{
		if( $_SESSION['sign']==2)header('Location: cusMenu.php');
	}
	else header('Location: index.php');

	if(isset($_POST['sourceA'])&&isset($_POST['destinA'])&&isset($_POST['type'])&&isset($_POST['nameA'])&&isset($_POST['datea'])&&isset($_POST['timea']))
	{
		$sa=$_POST['sourceA'];
		$da=$_POST['destinA'];
		$ta=$_POST['type'];
		$fa=$_POST['nameA'];
		$d=$_POST['datea'];
		$ti=$_POST['timea'];
		if(empty($sa)||empty($da)||empty($ta)||empty($fa)||empty($d)||empty($ti))
		{
			echo "Please Fill All Field\n";
		}
		else
		{
			/*$bll=0;
			$qwe="SELECT * from `bus_fair` where `Source`='$sa' and `destination`='$da' and `type`='$ta'";
			$qqw=mysql_query($qwe);
			if(!$qqw)
			{
				echo "Wrong Root.";
				$bll=1;
			}
			$qwe="SELECT * from `bus_t` where `source`='$sa' and `destination`='$da' and `type`='$ta' and `name`='$fa'";
			$qqw=mysql_query($qwe);
			if(!$qqw)
			{
				echo "Wrong Bus for this root.";
				$bll=1;
			}
*/

			//if($bll==0)
			{

			$cda=date_default_timezone_get();//date("Y-m-d h:i:s");
			$cda= date("Y-m-d H:i:s", strtotime($cda . " +6 hours"));
			$cti=date('Y-m-d H:i:s', strtotime("$d $ti"));
			
			//date_add($cda,date_interval_create_from_date_string("6 hours"));
			echo $cda." ".$cti;
			if($cda>=$cti)
			{
				echo "Please check the date. You add before 6 hours of arrival.";
			}
			else
			{
				
					//select b_id
				$q="select * from `bus_t` where `source`='$sa' and `destination`='$da' and `type`='$ta' and `name`='$fa'";
				$qr=mysql_query($q);
				$bID=mysql_result($qr, 0, 'b_id');
					//EO select b_id

	//updated version, [if there is no row for this date, we can already build rows in this before processing next page]

				$q="select * from 	`seats` where `bus_id`='$bID' and `date`='$d' and `time`='$ti'";
				$qr=mysql_query($q);
				$r=mysql_num_rows($qr);
				if(!$r)
				{
					require 'SeatArray.php';
					$us=$_SESSION['user_id'];
					for($i=0;$i<count($sA);$i++)
					{
						$q="INSERT INTO `busticket`.`seats` (`sno`,`bus_id`, `seat_no`,`date`,`time`,`modified_by`,`booked_by`,`booked_time`,`available`) VALUES (NULL,'$bID','$sA[$i]','$d','$ti','$us','1',NULL,'0')";
						$qr=mysql_query($q);
					}
				}

				//update end

				$_SESSION['dt']=$d;
				$_SESSION['tm']=$ti;
				$_SESSION['bID']=$bID;

				header('Location: modSeat1.php');
			}	
			}
		}
	}

?>

<html>
<head>
	<title>Modify seats</title>
	<!-- bootstrap starts here -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
	<script src="script/bootstrap/bootstrap_min.js"></script>
	<script src="script/bootstrap/jquery_min.js"></script>
	<!-- bootstrap ends here -->
</head>
<body>
<body>
<div class="container">
<div class="col-lg-12 text-center">
<h1>Enter Bus name and its info</h1>
<div  align="left"><a href="adminMenu.php">Back</a></div>

<div class="col-sm-4">
</div>
<div class="col-sm-4">

<form action="<?php echo $current_site; ?>" method="post"  role="form">
	<div class="form-group">
			<label for="nameA">Bus Name: </label>
			<input id="nameA" name="nameA" placeholder="Bus Name" class="form-control"/>
	</div>
	<div class="form-group">
			<label for="sourceA">Source: </label>
			<input id="sourceA" name="sourceA" placeholder="Source Address" class="form-control"/>
	</div>
	<div class="form-group">
			<label for="destinA">Destination: </label>
			<input id="destinA" name="destinA" placeholder="Destination Address" class="form-control"/>
	</div>
	<div class="form-group">
				<label for="type">Type: </label>
				<input type="radio" name="type" id="type" value="AC"> AC
				<input type="radio" name="type" id="type" value="nAC"> Non AC
	</div>
	<div class="form-group">
			<label for="datea">Date: </label>
			<input id="datea" name="datea" placeholder="YYYY-MM-DD" class="form-control"/>
	</div>
	<div class="form-group">
			<label for="timea">Time: </label>
			<input id="timea" name="timea" placeholder="HH:MI:SS" class="form-control"/>
	</div>
	<div class="form-group">
			<input name="ssubmit" type="submit" value="Go!" class="btn btn-warning"/>
	</div>
</form>
</div>

<div class="col-sm-4">
</div>

</div>
</div>
</body>
</html>