<?php
    session_start();
    
    function logged_in()
    {
        return (isset ($_SESSION['user_id']));
    }
    
    function confirm_login()
    {
        if (!logged_in())
        {
            redirect_to("index.php");
        
        }
    }
    
    
?>