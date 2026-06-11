<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "appweb";
	$port = '8080';
	$link = new mysqli($host, $user, $pass, $dbname);
	mysqli_set_charset($link, "utf8");
    if ($link->connect_error) {
        die("Connection failed: " . $link->connect_error);
    }
?>
