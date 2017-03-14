
<?php
//complete prae
require 'core.inc.php';
require 'Database/connect.php';
//session_start();

	if(isset($_POST['mob'])&&isset($_POST['pass']))
	{
		$u=$_POST['mob'];
		$p=$_POST['pass'];
		if(empty($u)||empty($p))
			echo "Please enter username and password";
		else 
		{
			//$p=md5($p);
			$q="select * from `customer_t` where `mobile`='$u' and `pass`='$p'";
			$qur=mysql_query($q);
			$ro=mysql_num_rows($qur);
			if($ro==1)
			{
				echo "Succesfull\n";
				$_SESSION['sign']=2;
				$_SESSION['cuser_id']=mysql_result($qur,0,'c_id');
				header('Location: cusMenu.php');
			}
			else
			{
				echo "Wrong username and password.\n";
			}
		}
	}

	include 'signin.php';
?>