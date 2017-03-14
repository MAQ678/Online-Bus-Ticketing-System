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
<a href="cusMenu.php">Back<br></a>
<div class="col-lg-12 text-center">
<h1>Ticket confirmation menu</h1>
<div class="col-sm-2">
</div>
<div class="col-sm-8">

<table class="table table-striped">  <!-- bootstrap -->
<thead>
	
	<tr>
		<th><strong>Bus_id</strong></th>
		<th><strong>Seat No</strong></th>
		<th><strong>Date</strong></th>
		<th><strong>Time</strong></th>

	</tr>
	</thead>
	<tbody>
<?php
	
	$cda=date_default_timezone_get();
	$cda= date("Y-m-d", strtotime($cda));

	$us=$_SESSION['cuser_id'];
	$q="SELECT * from `seats` where `available`='1' and `booked_by`='$us' and `date`>='$cda'";
	$qr=mysql_query($q);
	if($qr)
	{
		$ro=mysql_num_rows($qr);
		if($ro==0)
		{
			echo "<div class='alert alert-info'>No ticket.</div>";
		}
		else
		{
			for($i=0;$i<$ro;$i++)
			{
				$bID=mysql_result($qr, $i,'bus_id');
				$sn=mysql_result($qr, $i,'seat_no');
				$dt=mysql_result($qr, $i,'date');
				$tm=mysql_result($qr, $i,'time');

				echo " 
				<tr align='left'>
					<td>$bID</td>
					<td>$sn</td>
					<td>$dt</td>
					<td>$tm</td>
				</tr>
					";
			}
		}
	}




		
	
?>
	</tbody>
</table>

</div>
<div class="col-sm-2">
</div>

</div>
</div>
</body>
</html>