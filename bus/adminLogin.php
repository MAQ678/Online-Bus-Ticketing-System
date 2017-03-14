<?php
//complete prae
require 'core.inc.php';
require 'Database/connect.php';

if(isset($_POST['mob'])&&isset($_POST['pass']))
{
	$u=$_POST['mob'];$p=$_POST['pass'];

	if(!empty($u)&&!empty($p))
	{
		$q="select `id` from `admin_t` where `name`='$u' and `pass`='$p'";
		$qrun=mysql_query($q);
		if($qrun)
		{
			$qnum_row=mysql_num_rows($qrun);
			if($qnum_row==1)
			{
				$user_id=mysql_result($qrun, 0,'id');
				 $_SESSION['sign']=1;
				 $_SESSION['user_id']= $user_id;
				 header('Location: adminMenu.php');
			}
			else
			{
				 echo "Invalid Username or Password";
			}
		}
		//else echo "prcdf";
	}
	else
	{
		echo "enter the username & password";
	}
}

include 'signin.php';

?>