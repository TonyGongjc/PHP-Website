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
    <nav class="navbar navbar-default" role="navigation">
		<div class="container-fluid">
		<div class="navbar-header">
        <div id="frame">
            <h4>Goods List</h4>
		</div>
		<div>
			<ul class="nav navbar-nav">
			<li><a href="food.php">Food Department</a></li>
			<li><a href="electronics.php">Electronics Department</a></li>
			<li><a href="clothes.php">Clothes Department</a></li>
			<li class="active"><a href="add.php">Add a good</a></li>
            <li><a href="home.php">Go back</a></li>
        </div>
	</nav>

            <form class="form-horizontal" role="form" action="add.php" method="POST">
                <div class="form-group">
                    <label for="item_name" class="col-sm-2 control-label">Enter Item Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="item_name" required="required" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="item_name" class="col-sm-2 control-label">Enter Price</label>
                    <div class="col-sm-10">
                        <input type="text" name="itme_price" required="required" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="select" class="col-sm-2 control-label">Choose Department</label>
                    <div class="col-sm-10">
                                <select name="select">
                                <option value=1>Food Department</option>
                                <option value=2>Electronics Department</option>
                                <option value=3>Clothes Department</option><br/><br/>
                                <input type="submit" value="Add"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </body>
</html>

<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $con=mysqli_connect("database2.cs.tamu.edu","tonygongjicheng","58110433Aa.");//connect to server
    $item_name=mysqli_real_escape_string($con, $_POST['item_name']);
    $item_price=mysqli_real_escape_string($con, $_POST['itme_price']);
    $item_department=mysqli_real_escape_string($con, $_POST['select']);
    $bool= true;

    mysqli_connect("database2.cs.tamu.edu","tonygongjicheng","58110433Aa.") or die(mysql_error());
    mysqli_select_db($con,"tonygongjicheng-onlineStore") or die("Cannot connect to database");
    $query = mysqli_query($con,"Select * from goods") or die("Cannot do query");
    
    while($row = mysqli_fetch_array($query,MYSQLI_ASSOC))
    { //display all rows from query
        $table_item =$row['name'];
        if($item_name == $table_item) //checks if there are any matching fields
        {
            $bool = false;
            Print '<script>alert("Item name has been taken!");</script>';
            Print '<script>window.location.assign("add.php");</script>';
        } 
    }

    if($bool)
    {
        echo "Item name entered is: " . $item_name . "<br/>";
        echo "Price entered is: " . $item_price;
    
        mysqli_query($con,"INSERT INTO goods (name, price, department) VALUES ('$item_name','$item_price','$item_department')");
        Print '<script>alert("Successfully Added!");</script>';
        Print '<script>window.location.assign("shop.php");</script>';
        
    }


  
}
?>