<?php
    include ("includes/connection.php");
    include ("includes/functions.php");
    include ("includes/session.php");
    //confirm_login();
?>
<?php
    $users = $_POST["user"];
    $how_many = count($users);

    if (isset($_POST["adm"]))
    {
        for ($i=0; $i<$how_many; $i++)
        {
            $query = "UPDATE `dfolt`.`users` SET `info` = 'admin' WHERE CONVERT( `users`.`user_id` USING utf8 ) = '{$users[$i]}' LIMIT 1 ;";
             if (!mysql_query($query))
            {
              die("Query Failed " . mysql_error());
            }
        }
            
       
    }
     
    elseif (isset($_POST["sub"]) && $how_many>0)
     {
         
         for ($i=0; $i<$how_many; $i++)
         {
            $query = " DELETE FROM `users` WHERE CONVERT(`users`.`user_id` USING utf8) = '{$users[$i]}' LIMIT 1;";
            if (!mysql_query($query))
            {
              die("Query Failed " . mysql_error());
            }
            
         }
         
        
     }
    
    elseif (isset($_POST["sna"]))
    {
        for ($i=0; $i<$how_many; $i++)
        {
            $query = "UPDATE `dfolt`.`users` SET `info` = '' WHERE CONVERT( `users`.`user_id` USING utf8 ) = '{$users[$i]}' LIMIT 1 ;";
             if (!mysql_query($query))
            {
              die("Query Failed " . mysql_error());
            }
        }
            
       
    }
     
    
    //removeuser();
    
    
?>
 <?php
    if (isset ($connection))
        {
            mysql_close ($connection);
        }
?>
<?php
    redirect_to("edituser.php");
?>