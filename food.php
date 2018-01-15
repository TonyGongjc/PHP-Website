<!DOCTYPE html>
	<head>
		<title>Online Shopping</title>
        <script type="text/javascript" src="js/food.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="/js/jquery-1.12.3.js"></script>
        <link rel="stylesheet" type="text/css" href="universal.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	</head>
    <style>
    DIV.table 
    {
        display:table;
    }
    FORM.tr, DIV.tr
    {
        display:table-row;
    }
    SPAN.td
    {
        display:table-cell;
    }
    </style>
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
        <div id="frame">
            <h4>Goods List</h4>
		</div>
		<div>
			<ul class="nav navbar-nav">
			<li class="active"><a href="food.php">Food Department</a></li>
			<li><a href="electronics.php">Electronics Department</a></li>
			<li><a href="clothes.php">Clothes Department</a></li>
			<li><a href="add.php">Add a good</a></li>
            <li><a href="home.php">Go back</a></li>
        </div>
	    </nav>
    
    
    
        <div class="talbe">
            <table id="table_id" class="display">
                <thead>
                    <tr>
                        <th>Item ID</th>
                        <th>Item Name</th>
                        <th>Price</th>
                        <th>Add to Cart</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $con = mysqli_connect("database2.cs.tamu.edu","tonygongjicheng","58110433Aa."); //connect to server
                        mysqli_connect("database2.cs.tamu.edu","tonygongjicheng","58110433Aa.") or die(mysql_error());
                        mysqli_select_db($con, "tonygongjicheng-onlineStore") or die("Cannot connect to database");
                        $userID = $_SESSION['user_id'];
                        $query = mysqli_query($con, "Select id, name, price  
                                                    FROM goods
                                                    Where department=1;");
                        while ($row = mysqli_fetch_array($query, MYSQL_BOTH)) {
                            Print "<tr>";
                            Print '<td>' . $row['id'] . "</td>";
                            Print '<td>' . $row['name'] . "</td>";
                            Print '<td>' . $row['price'] . "</td>";
                            Print '<td> <form class= "tr"action="food.php" method="POST">
                                                        Enter quantity:  <span class="td"><input type="text" name="details"/></span>
                                                        <span class="td"><input type= "hidden" name="id" value='. $row['id'].'></span>
                                                        <button type="submit"/>Add</button> </td> 
                                                        </form>';
                            Print '<td><a href="#" onclick="myFunction(' . $row['id'] . ')">delete</a> </td>';
                            Print "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
                    </div>
    </body>
    </div>
    <script>
        $(document).ready( function () {
        $('#table_id').DataTable();
        } );

        function myFunction(id)
		{
			var r=confirm("Are you sure you want to delete this record?");
			if (r==true)
			  {
			  	window.location.assign("item_delete.php?id=" + id);
			  }
		}
    </script>
    
    <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $con = mysqli_connect("database2.cs.tamu.edu","tonygongjicheng","58110433Aa."); //connect to server
            mysqli_connect("database2.cs.tamu.edu","tonygongjicheng","58110433Aa.") or die(mysql_error());
            mysqli_select_db($con, "tonygongjicheng-onlineStore") or die("Cannot connect to database");
            $details = mysqli_real_escape_string($con, $_POST['details']);
            
            $user_id = $_SESSION['user_id'];
            $itemID= $_POST['id'];
            $sql = "select * from shoppingList where userID=$user_id and itemID=$itemID";
            $result = mysqli_query($con,$sql);
        
            //$sql = "UPDATE list SET details= '$details',public='$public', date_edited='$date', time_edited='$time' WHERE id='$id'";

            if (mysqli_num_rows($result)!=0) {
                $sql = "update shoppingList SET quantity=quantity+$details where userID='$user_id' and itemID='$itemID'";
                
                if($con->query($sql)===true){
                   
                }else{
                    echo "Error: " . $sql . "<br>" . $con->error;
                };
            } else {
                $sql = "INSERT INTO shoppingList (userID, itemID, quantity) VALUES ('$user_id', '$itemID', '$details')";
                echo "here2";
                $con->query($sql);
            }
            //mysqli_query($con, "UPDATE list SET details= '$details',public=$'public', date_edited='$date', time_edited='$time' WHERE id='$id'");
            //header("location:home.php");
        }
    ?>
</html>