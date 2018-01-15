<?php
session_start();
if ($_SESSION['user']) {
} else {
	header("location: index.php");
}

if ($_SERVER['REQUEST_METHOD'] == "GET") {
	$con = mysqli_connect("database2.cs.tamu.edu","tonygongjicheng","58110433Aa.");
	
	mysqli_select_db($con, "onlineStore") or die("Cannot connect to database");
    $id = $_GET['id'];
   
	$sql = "DELETE FROM goods WHERE id='$id'";
	if ($con->query($sql) === TRUE) {
        echo "Delete Successfully";
        $sql = "CREATE TRIGGER item_delete
                AFTER DELETE ON goods
                    REFERENCING OLD ROW AS Old
                FOR EACH ROW
                    DELETE FROM shoppingList WHERE itemID='$id'";
        $con->query($sql);
	} else {
		echo "Error: " . $sql . "<br>" . $con->error;
	}
	header("location: home.php");
}
?>