<!DOCTYPE html>

<?php
	require 'core.inc.php';
	require 'Database/connect.php';
	require 'checkLogin.php';
	require 'SeatArray.php';

if(isset( $_SESSION['sign']))
	{
		if( $_SESSION['sign']==2)header('Location: cusMenu.php');
	}
	else header('Location: index.php');

?>


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
<h1>Select Your Desire Seats</h1>
<div  align="left"><a href="adminMenu.php">Back</a></div>
<?php
	$us=$_SESSION['user_id'];
	//set action perform
	$vv=0;$rr=0;
	/*if(isset($_SESSION['dt']))
	echo "$_SESSION['dt']";*/
	///echo count($sA);
	for($i=0;$i<count($sA);$i++)
	{
	//	echo "you got me";
		if(isset($_POST[$sA[$i]]))
		{
			$vv=1;
			$rr=$_POST[$sA[$i]];
			//update index
		//	echo $rr."\n"; 
			$q="UPDATE `busticket`.`seats` SET `booked_by`='2' where `seats`.`sno`='$rr'";
			$qr=mysql_query($q);
			$q="UPDATE `busticket`.`seats` SET `modified_by` = '$us' WHERE `seats`.`sno` = '$rr';";
			$qr=mysql_query($q);
			$q="UPDATE `busticket`.`seats` SET `available` = '1' WHERE `seats`.`sno` = '$rr';";
			$qr=mysql_query($q);

		}
	}
	if($vv==0)
		echo "<div class='alert alert-info'>You didn't select any.\n</div>";
	else
	{
		//echo "Updated";
		//echo "<a href='adminMenu.php'> click</a>";
		header('Location: adminMenu.php');
	}

?>
 <?php
 	if(!isset($_SESSION['bID'])||!isset($_SESSION['dt'])||!isset($_SESSION['tm']))header('Location: adminMenu.php');
	$bID=$_SESSION['bID'];
	$d=$_SESSION['dt'];
	$ta=$_SESSION['tm'];
	unset($_SESSION['bID']);
	unset($_SESSION['dt']);
	unset($_SESSION['tm']);

	$j=0;$k=0;
	for($i=0;$i<count($sA);$i++)
	{
		$q="select * from 	`seats` where `bus_id`='$bID' and `date`='$d' and `time`='$ta' and `seat_no`='$sA[$i]'";
		$qr=mysql_query($q);
		$res=mysql_result($qr, 0, 'booked_by');//
		if($res==1)
		{
			$iAv[$j]=$sA[$i];
			$Av[$j++]=mysql_result($qr, 0, 'sno');
		}
		else
		{
			$ibk[$k]=$sA[$i];
			$bk[$k++]=mysql_result($qr, 0, 'sno');
		}
	}
	
 ?>
 <div class="col-sm-2">
</div>
<div class="col-sm-8">

 <form  action="<?php echo $current_site; ?>" method="post" role="form">
 	<div class="form-group">
 			<div class="well well-sm"> <p>Available Seats:<br></p></div>
 			<?php
 				if(!$j)
 				{
 					echo "<div class='alert alert-danger'>No available seats.</div>";
 				}
 				else
 				{
 					for($i=0;$i<count($Av);$i++)
 					{
 						//echo $iAv[$i]."\n";
 						echo "<label class='checkbox-inline'><input type='checkbox' name='$iAv[$i]' id='type' value='$Av[$i]'> ".$iAv[$i]."</label>";
 					}

 				}
 				echo "<br>";


 			?>

 		</div>
 	<div class="form-group">
			<input name="ssubmit" type="submit" value="Go!" class="btn btn-info"/>
	</div>

 </form>
 </div>

<div class="col-sm-2">
</div>

</div>
</div>

</body>
</html>