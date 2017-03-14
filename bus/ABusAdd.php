<!DOCTYPE html>

<?php

//complete prae
	require 'core.inc.php';
	require 'Database/connect.php';
	require 'checkLogin.php';
	if(isset( $_SESSION['sign']))
	{
		if( $_SESSION['sign']==2)header('Location: cusMenu.php');
	}
	else header('Location: index.php');

	if(isset($_POST['sourceA'])&&isset($_POST['destinA'])&&isset($_POST['type'])&&isset($_POST['nameA']))
	{
		$sa=$_POST['sourceA'];
		$da=$_POST['destinA'];
		$ta=$_POST['type'];
		$fa=$_POST['nameA'];
		if(empty($sa)||empty($da)||empty($ta)||empty($fa))
		{
			echo "Please Fill All Field\n";
		}
		else
		{

			$q="select * from `bus_fair` where `Source`='$sa' and `destination`='$da' and `type`='$ta'";
			$qr=mysql_query($q);
			$ro=mysql_num_rows($qr);
			if($ro)
			{

				$q="select * from `bus_t` where `source`='$sa' and `destination`='$da' and `type`='$ta' and `name`='$fa'";
				$qr=mysql_query($q);
				$ro=mysql_num_rows($qr);
				if($ro)echo "You already have a entry in this data";
				else
					{//modify added_by
						$us=$_SESSION['user_id'];
						$q="INSERT INTO `busticket`.`bus_t` (`b_id`, `name`, `source`, `destination`, `type`, `added_by`) VALUES (NULL,'$fa','$sa','$da','$ta','$us')";
						$qr=mysql_query($q);
						$q="INSERT INTO `busticket`.`bus_t` (`b_id`, `name`, `source`, `destination`, `type`, `added_by`) VALUES (NULL,'$fa','$da','$sa','$ta','$us')";
						$qr=mysql_query($q);
						header('Location: adminMenu.php');
					}
			}
			else echo "I don't know any root like this. You should try to add it first.\n";
		}
	}
?>


<html>
<head>
	<title>Add a new bus</title>
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

				<label for="type">Type: </label>
				<input type="radio" name="type" id="type" value="AC"> AC
				<input type="radio" name="type" id="type" value="nAC"> Non AC
	<div class="form-group">
			<input name="ssubmit" type="submit" value="Go!" class="btn btn-success"/>
	</div>
</form>
</div>

<div class="col-sm-4">
</div>

</div>
</div>
</body>
</html>