<?php
    if (isset ($_POST['regbut']))
    {
        header("location:register.php");
        exit;
    }
     if (isset ($_POST['admin']))
    {
       $admin= 1;
    }
?>
<?php
    include ("includes/connection.php");
    include ("includes/functions.php");
    include ("includes/session.php");
?>

<?php

    echo " <div>";
    
    if (isset ($_POST['user']) && isset ($_POST['pas']) && $_POST['user'] != "" && $_POST['pas'] != "")
    {
        $user = $_POST['user'];
        $pass = $_POST['pas'];
        $pas = sha1($pass);
        $query = "Select  * from users ";
        $query .= "where user_id = '{$user}' and hashed_password = '{$pas}'";
        $result_set = mysql_query ($query);
        confirm_query ($result_set);
        if (mysql_num_rows($result_set) == 1)
        {
           $new = mysql_fetch_row($result_set);
           if (isset($admin) && $admin==1)  
           {
                if ($new['5']=="admin" || $new['5']=="sadmin")
                {
                    $_SESSION['admin'] = "t";
                }
                else
                {
                    header("location:index.php?lus=1");
                    exit;
                }
           }
           $_SESSION['user_id'] = $new['0'];
           $_SESSION['user_name'] = $new['3'];
           $_SESSION['user_sex'] = $new['6'];
           $_SESSION['last_login'] = $new['2'];
           
           $dt = $dt = date("y-m-d H:i:s", time()) ;
                
           $ip = $_POST['ip'];     
  

                
           if(isset($_SESSION['admin']))
           {
                $inf = "adm";
           }
           else
           {
                $inf = " ";
           }
           //echo $_SESSION['user_id'] . ":" . $dt . ":" . $ip . ":" . $inf;
           //die();
           $qery = "INSERT INTO `dfolt`.`timelog` (`user_id` ,`login` ,`ip` ,`info`)
                    VALUES ('{$_SESSION['user_id']}', '{$dt}', '{$ip}', '{$inf}') ;" ;
            $qery2 = "SELECT `id`, `login` FROM `dfolt`.`timelog` ORDER BY `login` DESC LIMIT 1 ;";
            mysql_query($qery);            
            $ress = mysql_query($qery2);
            $ressa = mysql_fetch_array($ress);
            $_SESSION['log'] = $ressa[0];
            $qery3 = "UPDATE `dfolt`.`users` SET `last_login` = '{$ressa[1]}' WHERE CONVERT( `users`.`user_id` USING utf8 ) = '{$_SESSION['user_id']}' LIMIT 1 ;";
            mysql_query($qery3);
            header("location:noticeboard.php");
            exit; 
            
        }
        else
        {
            header("location:index.php?lus=1");
            exit;    
        }
    }
    else
    {
        header("location:index.php?lus=1");
        exit;    
    }

?>

<?php
    echo $enettt;
    include("includes/footer.php");
?>