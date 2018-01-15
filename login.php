<html>
    <head>
        <title>Online Shopping</title>
        <link rel="stylesheet" type="text/css" href="login.css">
        <script type="text/javascript" src="js/login.js"></script>
    </head>

    <body>
        <div id="login_frame">
            <p id="image_logo"><img src="images/login/fly.png"></p>

            <form action="checklogin.php" method="POST">
                    <p><label class="label_input">Username</label><input type="text"  name="username" required="required" class="text_field"/></p>
                    <p><label class="label_input">Password</label><input type="password"  name="password" required="required" class="text_field"/></p>
                    <input type="submit"  id="btn_login" value="Login"/>
                    <a href="index.php">Click here to go back<br/><br/>
            </form>
        </div>
    </body>
</html>