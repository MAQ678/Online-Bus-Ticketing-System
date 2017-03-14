<?php
	require 'core.inc.php';
require 'Database/connect.php';

session_destroy();
header('Location: index.php');
?>
