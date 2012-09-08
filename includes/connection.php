<?php
    include ("preference.php");
    //Creating connection
    $connection = mysql_connect(DB_SERVER,DB_USER,DB_PASSWORD);
    if (!$connection)
    {
        die("Database connection failed :" . mysql_error());
    }

    //selceting database
    $db = mysql_select_db (DB_NAME, $connection);
    if (!$db)
    {
        die("Databse connection faile at step 2" . mysql_error());
    }
?>
    
    