<!DOCTYPE html>

<?php 
require 'core.inc.php';
require 'Database/connect.php';

//echo "sfdfsdf";
//echo $_POST['cusName'];

	if(isset($_POST['cusName']))
	{
		$na=$_POST['cusName'];
		$ad=$_POST['cusAdd'];
		//$ge=$_POST['gend'];
		$mo=$_POST['cmobile'];
		$pa=$_POST['cusPass'];
		if(empty($na)||empty($ad)||empty($mo)||empty($pa))
		{
			echo "Please fullfill every field";
		}
		else 
		{
			$qu="Select * from `customer_t` where `mobile`=".$mo;
			$qur=mysql_query($qu);
			$ro=mysql_num_rows($qur);
			if($ro)echo "You already have a account on this mobile number";
			else
			{
				/*
				$qu="Select * from `customer_t`;";
				$qur=mysql_query($qu);
				$ro=mysql_num_rows($qur);
				$ro++;
				echo $ro;
				echo "\n";
				*/
				///$pa=md5($pa);
				$qu="INSERT INTO `busticket`.`customer_t` (`c_id`, `name`, `mobile`, `pass`, `adress`, `gender`) VALUES (NULL,'$na','$mo','$pa','$ad', 'male')";
				if(mysql_query($qu))
					{
						echo "Successfully created";
						header('Location: index.php');
					}

			}
		}
	}
	
 ?>
<html>
<head>
	<title>Sign up</title>
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
<h1>Sign up</h1>
<div class="col-sm-4">
</div>
<div class="col-sm-4">

<form action="<?php echo $current_site; ?>" method="post" role="form">
	<div class="form-group">

			<label for="cusName">Name: </label>
			<input id="cusName" name="cusName" placeholder="Username" class="form-control"/>
	</div>
	<div class="form-group">
			<label for="cusAdd">Address: </label>
			<input id="cusAdd" name="cusAdd" placeholder="Address" class="form-control"/>
	</div>
	<div class="form-group">
			<label for="gend">Gender: </label>
			<input type="radio" name="gend" id="gend" value="maleg"> Male
			<input type="radio" name="gend" id="gend" value="fmaleg"> Female
	</div>
	<div class="form-group">
			<label for="cmobile">Phone: </label>
			<input id="cmobile" name="cmobile" placeholder="Phone no" class="form-control"/>
	</div>
	<div class="form-group">
			<label for="cusPass">Password: </label>
			<input type="password" id="cusPass" name="cusPass" class="form-control"/>
	</div>
	<div class="form-group">
			<input name="ssubmit" type="submit" value="Go!" class="btn btn-info" />
	</div>
	
</form>
</div>

<div class="col-sm-4">
</div>

</div>
</div>
</body>
</html>