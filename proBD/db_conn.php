<?php

$sname= "localhost";
$unmae= "root";
$password = "";

$db_name = "magazin_telefoane";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {
	echo "Connection failed!";
}

//conexiune la baza de date