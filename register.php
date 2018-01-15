<html>
    <head>
        <title>Online Shopping</title>
        <link rel="stylesheet" type="text/css" href="register.css">
    </head>
    <body>
        <div id="frame">
            <h2>Registration Page</h2>
            <a href="index.php">Click here to go back</a><br/><br/>
                <form action="register.php" method="POST">
                Enter Username: <input type="text" name="username" required="required" /> <br/>
                Enter password: <input type="password" name="password" required="required" /> <br/>
                <input type="submit" value="Register"/>
                </form>
        </div>
    </body>
</html>

<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $con=mysqli_connect("database2.cs.tamu.edu","tonygongjicheng","58110433Aa.");//connect to server
    $username=mysqli_real_escape_string($con, $_POST['username']);
    $password=mysqli_real_escape_string($con, $_POST['password']);
    $bool= true;

    mysqli_connect("database2.cs.tamu.edu","tonygongjicheng","58110433Aa.") or die(mysql_error());
    mysqli_select_db($con,"tonygongjicheng-onlineStore") or die("Cannot connect to database");
    $query = mysqli_query($con,"Select * from user") or die("Cannot do query");
    
    while($row = mysqli_fetch_array($query,MYSQLI_ASSOC))
    { //display all rows from query
        $table_users =$row['username'];
        if($username == $table_users) //checks if there are any matching fields
        {
            $bool = false;
            Print '<script>alert("Username has been taken!");</script>';
            Print '<script>window.location.assign("register.php");</script>';
        } 
    }

    if($bool)
    {
        echo "Username entered is: " . $username . "<br/>";
        echo "Password entered is: " . $password;
    
        mysqli_query($con,"INSERT INTO user (username, password) VALUES ('$username','$password')");
        Print '<script>alert("Successfully Registered!");</script>';
        Print '<script>window.location.assign("login.php");</script>';
        
    }


  
}
?>