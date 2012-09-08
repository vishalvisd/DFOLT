<?php
   
    include ("includes/connection.php");
    include ("includes/functions.php");
    include ("includes/session.php");
    
?>

<?php

if (isset ($_GET['cid']))
{
    delete_by_id($_GET['cid'],2);
    redirect_to ("discussion.php?pid={$_GET['pid']} & curuser={$_SESSION['user_name']}");
}

elseif (isset ($_GET['pid']))
{
    delete_by_id ($_GET['pid'],1);
    redirect_to ("noticeboard.php");
    
}
?>