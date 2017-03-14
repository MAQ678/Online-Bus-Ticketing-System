
<?php
	require 'core.inc.php';
	require 'Database/connect.php';
//atfirst select customer on queue , then check available 1 for that

if(isset( $_SESSION['sign']))
	{
		if( $_SESSION['sign']==2)header('Location: cusMenu.php');
	}
	else header('Location: index.php');


$q="select distinct `booked_by` from `seats` where `available`='0' and `booked_by`>'2' and `booked_time` != 'NULL'";
$qr=mysql_query($q);
if($qr)
{

	$r=mysql_num_rows($qr);
	//echo $r;
	$vvv=0;
	if($r>0)
	{
		for($i=0;$i<$r;$i++)
		{
			$cid=mysql_result($qr, $i);
			if($cid)
			{
				$tot=0;
				if(isset($_POST[$cid])&&$_POST[$cid]==$cid)
				{
					$vvv=1;
					$tot++;
					$q="UPDATE `busticket`.`seats` SET `available` = '1' WHERE `booked_by`='$cid'";
					$qr=mysql_query($q);
					$q="UPDATE `busticket`.`seats` SET `booked_time` = NULL WHERE `booked_by`='$cid'";
					$qr=mysql_query($q);
				}
			}
			///$q="UPDATE `customer_t` SET `ticketD`=`ticketD`+'$tot' where `c_id`='$cid'";
		}

	}
	if($vvv==1)
	{
		echo "Success\n";
	}

}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Book confirmation</title>

	<meta charset="utf-8"/>
	<!-- bootstrap starts here -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
	<script src="script/bootstrap/bootstrap_min.js"></script>
	<script src="script/bootstrap/jquery_min.js"></script>
	<!-- bootstrap ends here -->
</head>
<body>

<!-- make a table which works likes as busSearch.php and there will be checkbox -->
<div class="container">
<div class="col-lg-12 text-center">
<h1>Book confirmation menu</h1>
<div  align="left"><a href="adminMenu.php">Back</a></div>

<div class='alert alert-success'><strong>Note:</strong> Select after confirming transaction.</div>

<div class="col-sm-2">
</div>
<div class="col-sm-8">

<form action="<?php echo $current_site; ?>" method="post" role="form">
<table class="table table-striped">  <!-- bootstrap -->
<thead>
	
	<tr>
		<th><strong>Customer ID</strong></th>
		<th><strong>Total number of seats</strong></th>
		<th><strong>Fare</strong></th>

	</tr>
	</thead>
	<tbody>
<?php
$q="select distinct `booked_by` from `seats` where `available`='0' and `booked_by`>'2' and `booked_time`!= 'NULL'";
$qr=mysql_query($q);
$r=mysql_num_rows($qr);
if($r==0)
{
	echo "Sorry no entry.";
}
else
{
	for($i=0;$i<$r;$i++)
	{
		$cid=mysql_result($qr, $i);
		$q="select `bus_id` from `seats` where `available`='0' and `booked_by`='$cid' and `booked_time` != 'NULL'";
		$qr1=mysql_query($q);
		$r1=mysql_num_rows($qr1);

		/*for($j=0;$j<$r1;$j++)//skipped as customer can select from one bus on a visit
		{
			$q=""
		}
		*/
		$bID=mysql_result($qr1, 0);
		$q="select * from `bus_t` where `b_id`='$bID'";
		$qr1=mysql_query($q);

		$sr=mysql_result($qr1, 0,'source');
		$ds=mysql_result($qr1, 0,'destination');
		$tp=mysql_result($qr1, 0,'type');
		//echo $sr." ".$ds." ".$tp;
		$q="select * from `bus_fair` where `Source`='$sr' and `destination`='$ds' and `type`='$tp'";
		$qr1=mysql_query($q);

		$fa=mysql_result($qr1, 0,'fair');
		//echo $fa;
		$total=$fa*$r1;//total fair
//check this line
		echo " 
			<tr align='left'>
				<td><input type='checkbox' name='$cid' id='$cid' value='$cid'> $cid</td>
				<td>$r1</td>
				<td>$total</td>
			</tr>
				";
	}
}
?>
	</tbody>
</table>

<div class="form-group">
<input type="submit" value="Go!" class="btn btn-danger"/>
</div>
</form>

</div>
<div class="col-sm-2">
</div>

</div>
</div>
</body>
</html>