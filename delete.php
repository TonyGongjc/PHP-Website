<?php
session_start();
if ($_SESSION['user']) {
} else {
	header("location: index.php");
}

if ($_SERVER['REQUEST_METHOD'] == "GET") {
	$con = mysqli_connect("database2.cs.tamu.edu","tonygongjicheng","58110433Aa.");
	
	mysqli_select_db($con, "tonygongjicheng-onlineStore") or die("Cannot connect to database");
	$id = $_GET['id'];
	$sql = "DELETE FROM shoppingList WHERE itemID='$id'";
	if ($con->query($sql) === TRUE) {
		echo "Delete Successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $con->error;
	}
	header("location: home.php");
}
?>