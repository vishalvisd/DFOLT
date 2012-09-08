<?php
 if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
?>
<?php
    include ("includes/functions.php");
    include ("includes/session.php");
    if (logged_in())
    {
        $location = "noticeboard.php";
        redirect_to($location);
    }
?>
<html lang="en">
<head>
    <title>D F O L T</title>
     <link href="stylesheets/index.css" rel="stylesheet" media="all" style="text/css" />
    <div style="text-align:center">
        <h1 style="letter-spacing:4px"> DFOLT </h1>
        <p>
            <h3>Increase Your Efficiency</h3>
        </p>
        <p>
            <h3></h3>
        </p>
    </div>
    <?php
        if (isset($_GET['logout']) && $_GET['logout']==1)
        {
            echo " <div style=\"position:absolute; left:400px\">
                You are Logged out!
            </div>";
        }
        elseif (isset($_GET['lus']) && $_GET['lus'] == 1)
        {
            echo " <div style=\"position:absolute; left:400px\">
                Login Unsuccessful...
            </div>";
        }
        elseif (isset($_GET['lus']))
        {
            echo " <div style=\"position:absolute; left:400px\">
                Oops Some Problem Occured...
            </div>";
        }
    ?>
    
</head>
<body>
    <div class="centre">
    <form action = "verify.php" method="post"> Username : <input type="text" value= "" name="user"> <br><br>
                                                Passsword : <input type="password" value="" name="pas"> <br><br>
                                                <input type="submit" value = "Login" name = "but">                                                    
                                                <input type="submit" value = "Register" name = "regbut">
                                                <input type="submit" value = "Login as Admin" name = "admin">
                                                <input type="hidden" value=<?php echo "{$ip}"; ?> name=ip>
    </form>
   
    </div>
    
</body>
</html>