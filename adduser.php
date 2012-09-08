<?php
    include ("includes/connection.php");
    include ("includes/functions.php");
?>
<?php
    
    if ($_POST['sex'] == 1)
    {
        $sex = "m";
    }
    else
    {
        $sex = "f";
    }
    
    $user = $_POST['name'];
    $pas = sha1($_POST['password']);
    $id = $_POST['userid'];
    $age = $_POST['age'];
    $query = "insert into users (user_id,hashed_password,name,age,sex)
                        values (\"{$id}\",\"{$pas}\",\"{$user}\",\"{$age}\",\"{$sex}\")";
    mysql_query ($query);
    redirect_to("index.php");
    
 
?>
