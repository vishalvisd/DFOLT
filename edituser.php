<?php
    include ("includes/connection.php");
    include ("includes/functions.php");
    include ("includes/session.php");
    //confirm_login();
?>

<html lang="en">
    <head>
        <title>DFOLT</title>
        <link href="stylesheets/public.css" rel="stylesheet" media="all" style="text/css" />
        <script language="javascript" type="text/javascript">
        function limitText(limitField, limitCount, limitNum) {
                	if (limitField.value.length > limitNum) {
                		limitField.value = limitField.value.substring(0,limitNum );
                	} else {
                		limitCount.value = limitNum - limitField.value.length;
                	}
        }
       </script>
   
    </head>
<body>
    <div id="header" style=" position:absolute; width:250px">
        <h1>DFOLT</h1>
    </div>
    <div id="header2" style="position:relative;left:250px">        
             <script language = "JavaScript">
                     var now = new Date();
                     var dayNames = new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
                     var monNames = new Array("January","February","March","April","May","June","July","August","September","October","November","December");
                     document.write(dayNames[now.getDay()] + " " + monNames[now.getMonth()] + " " + now.getDate() + ", " + now.getFullYear());
             </script>
    
	     <br><br><br>
    </div>
    <div style="position:relative; left:85%; top:1px; font-size:small">
        <a href="noticeboard.php">Back</a> &nbsp&nbsp&nbsp
        <a href="logout.php">Logout</a>
    </div>
    
    <div style="width:50%;position:relative;top:5%; left:6%;">
        <h2>Select the User you want <br><br>to edit</h2>
    </div>
    <div style="position:relative;left:40%;top:-2%;width:50%;">
        <table border="1">
        <tr>
              <th></th>
              <th>User ID</th>
              <th>Name</th>
              <th>Age</th>
              <th>Sex</th>
              

        </tr>
        <form action="remove_user.php" method="post">
        <?php
            $list_of_all_users = get_user_list();
            while ($user_detail = mysql_fetch_array($list_of_all_users))
            {
                if ($user_detail['0'] != $_SESSION['user_id'] && $user_detail['5'] != "sadmin")
                {
                    echo "<tr> <td> <input type=\"checkbox\" name=\"user[]\" value={$user_detail['0']}>
                    </td> <td> {$user_detail['0']}</td><td> {$user_detail['3']} </td><td> {$user_detail['4']} </td><td> {$user_detail['6']}</td><td> {$user_detail['5']}</td> </tr>";
                }
            }
            
            echo "</table>";
        ?>
        <br>
        <input type="submit" name="sub" value="Remove User" style="font-size:xx-small">
        <input type="submit" name="adm" value="Give Admin Status" style="font-size:xx-small">
        <input type="submit" name="sna" value="Remove Admin" style="font-size:xx-small">
        <form>
    </div>


<?php
    include("includes/footer.php");
?>
            