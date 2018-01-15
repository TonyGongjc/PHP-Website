<html>
	<head>
		<title>Online Shopping</title>
		<script type="text/javascript" src="js/food.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
        <script src="/js/jquery-1.12.3.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
        <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="universal.css">
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	</head>
	<?php
	session_start();
	if ($_SESSION['user']) {} else {
		header("location:index.php"); //redirects if user is not logged in
	}
	$user = $_SESSION['user'];
	?>
	<div class="container">
	<body>
		<nav class="navbar navbar-default" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<h4>Home Page</h4>
				</div>
			<div>
			<ul class="nav navbar-nav">
				<li><a href="food.php">Go shopping</a></li>
				<li><a href="orders.php">My orders</a></li>
				<li><a href="logout.php">Click here to logout</a></li>
			</div>
		</nav>

				<p>Hello <?php Print "$user"?>!</p> <!--Display user's name-->
		<h2 align="center">My list</h2>
		<div class="table">
			<table id="table_id" class="display">
				<thead>
					<tr>
						<th>Item Name</th>
						<th>Quantity</th>
						<th>Total Price</th>
						<th>Delete</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$con = mysqli_connect("database2.cs.tamu.edu","tonygongjicheng","58110433Aa."); //connect to server
					mysqli_connect("database2.cs.tamu.edu","tonygongjicheng","58110433Aa.") or die(mysql_error());
					mysqli_select_db($con, "tonygongjicheng-onlineStore") or die("Cannot connect to database");
					$userID = $_SESSION['user_id'];
					$query = mysqli_query($con, "Select b.name, a.quantity, CAST(a.quantity*b.price AS decimal(11,1)) AS total, itemID 
												FROM shoppingList AS a, goods AS b
												Where a.userID='$userID' AND a.itemID=b.id;");
					while ($row = mysqli_fetch_array($query, MYSQL_BOTH)) {
						Print "<tr>";
						Print '<td>' . $row['name'] . "</td>";
						Print '<td>' . $row['quantity'] . "</td>";
						Print '<td>' . $row['total'] . "</td>";
						Print '<td><a href="#" onclick="myFunction(' . $row['itemID'] . ')">delete</a> </td>';
						Print "</tr>";
					}
					?>
				</tbody>
			</table>
		</div>
		<a href="pay.php" class="btn btn-default btn-lg" role="button">Click to pay</a>
		<script>
			function myFunction(id)
			{
			var r=confirm("Are you sure you want to delete this record?");
			if (r==true)
			  {
			  	window.location.assign("delete.php?id=" + id);
			  }
			}

			$(document).ready( function () {
			$('#table_id').DataTable();
			} );
		</script>
	
	</body>
	</div>
</html>