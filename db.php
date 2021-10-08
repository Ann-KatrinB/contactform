<?php
	$host = "localhost";
	$user = "root";
	$pw = "";
	$db = "kontaktformular";

	$verbindung = mysqli_connect($host, $user, $pw, $db) or die(mysqli_connect_error());
?>