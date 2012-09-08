<?php
   
    include ("includes/connection.php");
    include ("includes/functions.php");
    include ("includes/session.php");
    
?>

<?php    
    add_comment($_POST['pid'],$_SESSION['user_id'],$_POST['limitedtextarea']);
    redirect_to ("discussion.php?pid={$_POST['pid']}&curuser={$_SESSION['user_name']}");

?>