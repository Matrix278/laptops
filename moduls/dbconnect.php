<?php
$host = "localhost";
$user = "username";
$psswd = "password";
$link = mysqli_connect($host, $user, $psswd);
mysqli_select_db($link, "databaseName");
mysqli_query($link, "SET NAMES utf8");
?>
