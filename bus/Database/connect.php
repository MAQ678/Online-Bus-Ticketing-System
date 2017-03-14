<?php
date_default_timezone_set('Asia/Dhaka');

$servername = "localhost";
$username = "root";
$password = "";
$my_db='busticket';

// Create connection
$conn =  @mysql_connect($servername, $username, $password);
$db=mysql_select_db("busticket",$conn);

///$adminid=mysql_query("select * from `admin_t`",$conn);

// Check connection

if(!$conn||!$db)die(mysql_error());
?> 