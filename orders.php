<html>
	<head>
		<title>Online Shopping</title>
		<script type="text/javascript" src="js/food.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
        <script src="/js/jquery-1.12.3.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
		<link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="universal.css">
		<script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	</head>
	<?php
	session_start();
	if ($_SESSION['user']) {} else {
		header("location:index.php"); //redirects if user is not logged in
	}
	$user = $_SESSION['user'];
	?>
	<body>
	<div class="container">
		<nav class="navbar navbar-default" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<h4>Orders</h4>
				</div>
			<div>
			<ul class="nav navbar-nav">
				<li><a href="food.php">Go shopping</a></li>
				<li><a href="home.php">My homepage</a></li>
				<li><a href="logout.php">Click here to logout</a></li>
			</div>
		</nav

		<p>Hello <?php Print "$user"?>!</p> <!--Display user's name-->
		<h2 align="center">My Orders</h2>
		<table id="table_id" class="display">
			<thead>
				<tr>
					<th>Item Name</th>
					<th>Quantity</th>
					<th>Total Price</th>
					<th>Time Posted</th>
                    <th>Delete</th>
				</tr>
			</thead>
		<?php
		$con = mysqli_connect("database2.cs.tamu.edu","tonygongjicheng","58110433Aa."); //connect to server
		mysqli_connect("database2.cs.tamu.edu","tonygongjicheng","58110433Aa.") or die(mysql_error());
		mysqli_select_db($con, "tonygongjicheng-onlineStore") or die("Cannot connect to database");
		$userID = $_SESSION['user_id'];
        $query = mysqli_query($con, "Select o.quantity as quantity, o.time_posted as time,
                                    o.date_posted as date, g.name as name , CAST(g.price*o.quantity as decimal(11,1))as price, o.order_id
                                 from orders as o, goods as g 
                                 where o.user_id=$userID and g.id=o.item_id;");
		while ($row = mysqli_fetch_array($query, MYSQL_BOTH)) {
			Print "<tr>";
			Print '<td>' . $row['name'] . "</td>";
            Print '<td>' . $row['quantity'] . "</td>";
            Print '<td>' . $row['price'] . "</td>";
			Print '<td>' . $row['date'] ."-". $row['time']. "</td>";
			Print '<td><a href="#" onclick="myFunction(' . $row['order_id'] . ')">delete</a> </td>';
			Print "</tr>";
		}
	    ?>
		</table>
	
		<script>
			function myFunction(id)
			{
			var r=confirm("Are you sure you want to delete this record?");
			if (r==true)
			  {
			  	window.location.assign("delete_orders.php?id=" + id);
			  }
			}

			$(document).ready( function () {
			$('#table_id').DataTable();
			} );
		</script>
		</div>
	</body>
</html>