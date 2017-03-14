<!-- template -->

<!DOCTYPE html>
<html>
<head>
	<title>Sign in</title>
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
<h1>Sign In</h1>
<div class="col-sm-4">
</div>
<div class="col-sm-4">
<form action="<?php echo $current_site;?>" method="post" role="form">

	<div class="form-group">
		
			<label for="mob">Userid: </label>
			<input type="text" name="mob" class="form-control"/>
		
	</div>
	<div class="form-group">
		
			<label for="pass">Password: </label>
			<input type="password"  name="pass" class="form-control"/>
		
	</div>
	<div class="form-group">
		
			<input type="submit" value="Log in" class="btn btn-info"/>
		
	</div>
	
</form>
</div>

<div class="col-sm-4">
</div>

</div>
</div>

</body>
</html>