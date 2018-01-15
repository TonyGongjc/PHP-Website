<html>
	<head>
		<title>Online Shopping</title>
        <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="universal.css">
        <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
    <div class="container">
        <?php
            session_start();
            if ($_SESSION['user']) {} else {
                header("location:index.php"); //redirects if user is not logged in
            }
            $user = $_SESSION['user'];
        ?>
        <nav class="navbar navbar-default" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<h4>Home Page</h4>
				</div>
			<div>
			<ul class="nav navbar-nav">
				<li><a href="food.php">Go shopping</a></li>
				<li><a href="home.php">My list</a></li>
				<li><a href="logout.php">Click here to logout</a></li>
			</div>
		</nav>
        <div id="frame">
            <h2>Orders</h2>
			<form class="form-horizontal" role="form" action="pay.php" method="POST">
                <div class="form-group">
                    <label for="address" class="col-sm-2 control-label">Address:</label>
                    <div class="col-sm-10">
                        <input type="text" name="address" required="required" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="card_num" class="col-sm-2 control-label">Card Number: </label>
                    <div class="col-sm-10">
                    <input type="text" name="card_num" required="required" /> <br/>
                    <input type="submit" value="PlaceOrder"/>
                </div>
            </form>
        </div>
    </div>
    </body>
<?php
  
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $con=mysqli_connect("database2.cs.tamu.edu","tonygongjicheng","58110433Aa.");//connect to server
        $address=mysqli_real_escape_string($con, $_POST['address']);
        $card_num=mysqli_real_escape_string($con, $_POST['card_num']);
        $time = strftime("%X");
        $date = strftime("%B %d, %Y");
        $userID = $_SESSION['user_id'];
       
    
        mysqli_connect("database2.cs.tamu.edu","tonygongjicheng","58110433Aa.") or die(mysql_error());
        mysqli_select_db($con,"tonygongjicheng-onlineStore") or die("Cannot connect to database");
        $query = mysqli_query($con,"Select itemID,quantity from shoppingList where userID='$userID'") or die("Cannot do query");
        while ($row = mysqli_fetch_array($query, MYSQL_BOTH)) 
        {
           //display all rows from query
            $item_id=$row['itemID'];
            $quantity=$row['quantity'];
          
            
           mysqli_query($con,"INSERT INTO orders (user_id, item_id, quantity, time_posted, date_posted, address, card_number)
                             VALUES ('$userID','$item_id','$quantity', '$time', '$date', '$address', '$card_num')");
        } 
        
    
        Print '<script>alert("Your Order has been placed!");</script>';
        Print '<script>window.location.assign("orders.php");</script>';
    
    
      
    }

?>
</html>