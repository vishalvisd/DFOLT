<?php
    include ("includes/connection.php");
    include ("includes/functions.php");
    include ("includes/session.php");
    
?>
<?php
    add_post($_POST['Title'], $_POST['limitedtextarea'])
    
?>
    
<?php
    if (isset ($connection))
        {
            mysql_close ($connection);
        }
?>
<?php
    redirect_to("noticeboard.php?user={$_SESSION['user_name']} & s={$_SESSION['user_sex']}");
?>