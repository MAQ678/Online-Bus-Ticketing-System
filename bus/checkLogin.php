<?php
	if(!isset( $_SESSION['sign']))
	{
		header('Location: index.php');
	}
	if(empty($_SESSION['sign']))header('Location: index.php');
?>