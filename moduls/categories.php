<?php
require_once "dbconnect.php";
$ln=$_GET['ln'];
	$categoryTable=mysqli_query($link, "SELECT * FROM vn_category WHERE langCode = '$ln' ");
	$categories=Array();
	$categoryName=Array();
	while($oneCategory=mysqli_fetch_assoc($categoryTable)){
	    $categories[$oneCategory['code']]=$oneCategory;
		$categoryName[$oneCategory['code']]=$oneCategory['name'];
	}
?>