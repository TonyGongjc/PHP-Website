<html>
  <head>
    <title>My first PHP website</title>
  </head>
<?php
session_start();
if ($_SESSION['user']) {} else {
	header("location:index.php"); //redirects if user is not logged in
}
$user = $_SESSION['user'];
$id_exists = false;
?>
  <body>
    <h2>Home Page</h2>
    <p>Hello <?php Print "$user"?>!</p> <!--Display user's name-->
    <a href="logout.php">Click here to logout</a><br/><br/>
    <a href="home.php">Return to Home page</a>
    <h2 align="center">Currently Selected</h2>
    <table border="1px" width="100%">
      <tr>
        <th>ID</th>
        <th>Details</th>
        <th>Post Time</th>
        <th>Edit Time</th>
        <th>Public Post</th>
      </tr>
<?php
if (!empty($_GET['id'])) {
	$id = $_GET['id'];
	$_SESSION['id'] = $id;
	$id_exists = true;
	$con = mysqli_connect("localhost", "root", ""); //connect to server
	mysqli_connect("localhost", "root", "") or die(mysql_error());
	mysqli_select_db($con, "mywebsite") or die("Cannot connect to database");
	$query = mysqli_query($con, "Select * from list Where id='$id'");
	$count = mysqli_num_rows($query);
	if ($count > 0) {
		while ($row = mysqli_fetch_array($query, MYSQL_BOTH)) {
			Print "<tr>";
			Print '<td align="center">' . $row['id'] . "</td>";
			Print '<td align="center">' . $row['details'] . "</td>";
			Print '<td align="center">' . $row['date_posted'] . " - " . $row['time_posted'] . "</td>";
			Print '<td align="center">' . $row['date_edited'] . " - " . $row['time_edited'] . "</td>";
			Print '<td align="center">' . $row['public'] . "</td>";
			Print "<tr>";
		}
	} else {
		$id_exists = false;
	}
}
?>
</table>
    <br/>
<?php
if ($id_exists) {
	Print '
      <form action="edit.php" method="POST">
        Enter new detail: <input type="text" name="details"/><br/>
        public post? <input type="checkbox" name="public[]" value="yes"/><br/>
        <input type="submit" value="Update List"/>
      </form>
      ';
} else {
	Print '<h2 align="center">There is no data to be edited.</h2>';
}
?>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$con = mysqli_connect("localhost", "root", ""); //connect to server
	mysqli_connect("localhost", "root", "") or die(mysql_error());
	mysqli_select_db($con, "mywebsite") or die("Cannot connect to database");
	$details = mysqli_real_escape_string($con, $_POST['details']);
	$public = "no";
	$id = $_SESSION['id'];
	$time = strftime("%X");
	$date = strftime("%B %d, %Y");

	foreach ($_POST['public'] as $list) {
		if ($list != null) {
			$public = "yes";
		}
	}

	$sql = "UPDATE list SET details= '$details',public='$public', date_edited='$date', time_edited='$time' WHERE id='$id'";

	if ($con->query($sql) === TRUE) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $con->error;
	}
	//mysqli_query($con, "UPDATE list SET details= '$details',public=$'public', date_edited='$date', time_edited='$time' WHERE id='$id'");
	//header("location:home.php");
}
?>