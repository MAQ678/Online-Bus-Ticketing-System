<?php

$servername = "localhost";
$username = "root";
$password = "";
$my_db='bus2';

// Create connection
$conn =  @mysql_connect($servername, $username, $password);
if(!$conn)die('Could not connect: ' . mysql_error());

$db_sel=mysql_select_db($my_db, $conn);
if(!$db_sel)
{
	$q="CREATE DATABASE $my_db";
	$qr=mysql_query($q);
	if($qr)echo "Created";
	else echo "problem";
}
$db=mysql_select_db($my_db,$conn);

//if(!$conn||!$db)die(mysql_error());

//creating admin table
$q="CREATE TABLE if not exists `admin_t` ( `id` INT(6) NOT NULL AUTO_INCREMENT , `name` VARCHAR(30) NOT NULL , `pass` VARCHAR(200) NOT NULL , PRIMARY KEY (`id`) ) ENGINE = InnoDB";
$qr=mysql_query($q);
//if(!$qr) echo "Non success.";

//creating bus_fair
$q="CREATE TABLE if not exists  `bus_fair` ( `Source` VARCHAR(20) NOT NULL , `destination` VARCHAR(20) NOT NULL , `type` VARCHAR(6) NOT NULL , `fair` INT(6) NOT NULL , PRIMARY KEY (`Source`, `destination`, `type`) ) ENGINE = InnoDB";
$qr=mysql_query($q);

$q="CREATE TABLE if not exists `bus_t` ( `b_id` INT(6) NOT NULL AUTO_INCREMENT , `name` VARCHAR(20) NOT NULL , `source` VARCHAR(20) NOT NULL , `destination` VARCHAR(20) NOT NULL , `type` VARCHAR(6) NOT NULL , `modified_by` INT(6) NOT NULL , PRIMARY KEY (`b_id`) ) ENGINE = InnoDB";
$qr=mysql_query($q);

$q="CREATE TABLE if not exists `customer_selection` ( `customer_id` INT(6) NOT NULL , `bus_id` INT(6) NOT NULL , PRIMARY KEY (`customer_id`, `bus_id`) ) ENGINE = InnoDB";
$qr=mysql_query($q);

$q="CREATE TABLE if not exists `customer_t` ( `c_id` INT(6) NOT NULL AUTO_INCREMENT , `name` VARCHAR(30) NOT NULL , `mobile` INT(20) NOT NULL , `pass` VARCHAR(200) NOT NULL , `address` VARCHAR(100) NOT NULL , `gender` VARCHAR(6) NOT NULL , `ticketD` INT(6) NOT NULL , PRIMARY KEY (`c_id`) ) ENGINE = InnoDB";
$qr=mysql_query($q);

$q="CREATE TABLE if not exists `pseats` ( `sno` INT(255) NOT NULL , `bus_id` INT(6) NOT NULL , `seat_no` VARCHAR(6) NOT NULL , `date` DATE NOT NULL , `time` TIME NOT NULL , `available` INT(6) NOT NULL , `modified_by` INT(6) NOT NULL , `booked_by` INT(6) NOT NULL , `booked_time` DATETIME NOT NULL , PRIMARY KEY (`sno`) ) ENGINE = InnoDB";
$qr=mysql_query($q);

$q="CREATE TABLE if not exists `seats` ( `sno` INT(255) NOT NULL AUTO_INCREMENT, `bus_id` INT(6) NOT NULL , `seat_no` VARCHAR(6) NOT NULL , `date` DATE NOT NULL , `time` TIME NOT NULL , `available` INT(6) NOT NULL , `modified_by` INT(6) NOT NULL , `booked_by` INT(6) NOT NULL , `booked_time` DATETIME NOT NULL , PRIMARY KEY (`sno`) ) ENGINE = InnoDB";
$qr=mysql_query($q);
?>