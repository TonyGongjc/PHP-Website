<?php
	session_start();
	$con = mysqli_connect("database2.cs.tamu.edu","tonygongjicheng","58110433Aa.");//connect to server  
	$username="";
	$password="";
	$username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
	echo $username;
    mysqli_connect("database2.cs.tamu.edu","tonygongjicheng","58110433Aa.") or die(mysql_error());
    mysqli_select_db($con,"tonygongjicheng-onlineStore") or die("Cannot connect to database");
    $query = mysqli_query($con,"SELECT * from user WHERE username='$username'");
    $exists = mysqli_num_rows($query);
    $table_users = "";
    $table_password = "";
    if($exists > 0)
    {
    	while($row = mysqli_fetch_assoc($query))
    	{
    		$table_users = $row['username'];
			$table_password = $row['password'];
			$user_id=$row['id'];
    	}
    	if(($username == $table_users) && ($password == $table_password))
    	{
    			if($password == $table_password)
    			{
					$_SESSION['user'] = $username;
					$_SESSION['user_id'] = $user_id;
    				header("location: home.php");
    			}
    	}
    	else
    	{
    		Print '<script>alert("Incorrect Password!");</script>';
    		Print '<script>window.location.assign("login.php");</script>';// redirect to login.php
    	}
    }
    else
    {
    	Print '<script>alert("Incorrect Username!");</script>';
    	//Print '<script>window.location.assign("login.php");</script>';
    }

?>