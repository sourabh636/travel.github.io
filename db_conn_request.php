<?php

$sname= "localhost";
$unmae= "root";
$password = "";

$db_name = "martin1";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {
	echo "Connection failed!";
}