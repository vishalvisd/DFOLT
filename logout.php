<?php
    include ("includes/connection.php");
    include ("includes/functions.php");
    include ("includes/session.php");
    if(isset($_SESSION['log']))
    {
        
        $dt = date("y-m-d H:i:s", time()) ;
        //echo $dt . " : " . $_SESSION['log'];
        //die();
        $query = "UPDATE `dfolt`.`timelog` SET `logout`='{$dt}' WHERE `timelog`.`id`={$_SESSION['log']} LIMIT 1 ; ";
        if (!mysql_query($query))
        {
            die(mysql_error());
        }
    }
    
    if (isset ($connection))
        {
            mysql_close ($connection);
        }
    
    $_SESSION = array();
    if (isset($_COOKIE[session_name()]))
    {
        setcookie(session_name(),'',time()-42000,'/');
    }
    session_destroy();
    redirect_to("index.php?logout=1");

?>