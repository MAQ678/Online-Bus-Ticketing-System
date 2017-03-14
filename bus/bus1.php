<?php
require 'core.inc.php';
require 'Database/connect.php';
require 'SeatArray.php';

if(isset( $_SESSION['sign']))
	{
		if( $_SESSION['sign']==1)header('Location: adminMenu.php');
	}
	else header('Location: index.php');
//coppied from admin
/*
$vv=0;$rr=0;
	for($i=0;$i<count($sA);$i++)
	{
		if(isset($_POST[$sA[$i]]))
		{
			$vv=1;
			$rr=$_POST[$sA[$i]];
			//update index
			$q="UPDATE `busticket`.`seats` SET `booked_by`='2' where `seats`.`sno`='$rr'";
			$qr=mysql_query($q);
			$q="UPDATE `busticket`.`seats` SET `modified_by` = '$us' WHERE `seats`.`sno` = '$rr';";
			$qr=mysql_query($q);

		}
	}
	if($vv==0)
		echo "You didn't select any.\n";
	else
	{
		header('Location: cusInfo1.php');
	}
	*/
?>



<!DOCTYPE html>
<html>
<head>
	<title>Chosse Your desire Seats</title>
	<!-- bootstrap starts here -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
	<script src="script/bootstrap/bootstrap_min.js"></script>
	<script src="script/bootstrap/jquery_min.js"></script>
	<!-- bootstrap ends here -->
</head>
<body>

<?php
/*$tav=10;
for($i=0;$i<$tav;$i++)
$av[$i]=$i+1;


<?php
echo "Available Seats are: ";
echo $av[0];
for($i=1;$i<$tav;$i++)
	echo " ,".$av[$i];
echo "<br>";

?>
<form action="cusInfo1.php" method="get">
<ul>
<li>
<?php
echo "Select your desire seats:<br>";
for($i=0;$i<$tav;$i++)
{
	echo"<input type='checkbox' name='".$av[$i]."' id='type' value='".$av[$i]."''> ".$av[$i];
}

?>
</li>
<li><input type="submit" value="Go!"/></li>
</ul>
</form>
<!-- same as bus , kintu ekhane ami table e dekhabo je ekta seat ki available naki.. jodi hoe tobe amra niche input tag e likhe buy korbo -->
*/
?>
<div class="container">
<div class="col-lg-12 text-center">
<h1>Select Your Desire Seats</h1>
<div  align="left"><a href="buyFair.php">Back</a></div>
<?php
$j=0;
$cid=$_SESSION['cuser_id'];
//$cda=date_default_timezone_get();
//$cda= date("Y-m-d 00:00:00", strtotime($cda));
$q="SELECT * from `seats` where `booked_by`='$cid' and (`available`='1' or `booked_time` is not NULL )";
		$qr=mysql_query($q);
		if($qr)
		$rw=mysql_num_rows($qr);
if($rw)
{
	echo "<div class='alert alert-warning'>You already bought ".$rw." tickets.</div>";
}
if($rw<4)
{
if(isset($_SESSION['sno']))
{
	$sno=$_SESSION['sno'];
	unset($_SESSION['sno']);
	$q="Select * from `seats` where `sno`='$sno'";
	$qr=mysql_query($q);
	$bID=mysql_result($qr, 0,'bus_id');
	$d=mysql_result($qr, 0,'date');
	$ta=mysql_result($qr, 0,'time');

	$j=0;$k=0;
	for($i=0;$i<count($sA);$i++)
	{
		$q="select * from 	`seats` where `bus_id`='$bID' and `date`='$d' and `time`='$ta' and `seat_no`='$sA[$i]' and `available`='0'";//edited
		$qr=mysql_query($q) ;//or die(mysql_error());;
		if($qr)
		{
			if(mysql_num_rows($qr))
			{
				$res=mysql_result($qr, 0, 'booked_by');//
				if($res==1)
				{
					$iAv[$j]=$sA[$i];
					$Av[$j++]=mysql_result($qr, 0, 'sno');
				}
			}
			
		}
		
		
	}
}
}

?>
<div class="col-sm-2">
</div>
<div class="col-sm-8">

<form  action="cusInfo1.php" method="post" role="form">
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