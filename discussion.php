<?php
    include ("includes/connection.php");
    include ("includes/functions.php");
    include ("includes/session.php");
    confirm_login();
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
    
    function validatenewcomment()
    {
	var x=document.forms["newcomment"]["limitedtextarea"].value
	if (x==null || x=="") 
	  {
	      alert("No Comments Maded !");
	      return false;
	  }
    }
    </script>
    
</head>
<body>
    <div id="container">
    <div id="header" style="width:100%;">
        <table style="width:100%;">
            <tr>
                <td>
                    <h1>DFOLT</h1>
                </td>
                <td align="right" style="padding-right:20px;">
                    <script language = "JavaScript">
                     var now = new Date();
                     var dayNames = new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
                     var monNames = new Array("January","February","March","April","May","June","July","August","September","October","November","December");
                     document.write(dayNames[now.getDay()] + " " + monNames[now.getMonth()] + " " + now.getDate() + ", " + now.getFullYear());
                    </script>
           
                     <br><br><br>
                     Username : <?php echo $_GET['curuser']; ?>
                     
                </td>
                
            </tr>
            
        </table>
    </div>
    <div id="header1">
	<ul>
	    <li><a style="color:blue;font-size:20px;" href="noticeboard.php">Back &nbsp&nbsp&nbsp&nbsp </a></li>
	    <li style="border-right:0px none !important; border-color:white"><a href="logout.php" style="font-size:20px;"> &nbsp&nbsp&nbsp&nbsp Logout</a></li>
	</ul>
		
    </div>
    
    <div style="margin-top:5%">
        <?php
            $poster1 = get_by_postid($_GET['pid']);
            $poster = mysql_fetch_array($poster1);
            echo "<div style=\"position:absolute; margin-top:30px; margin-left:5px; top:135px; color:green\"><b><br>" . $poster['3'] . "<br>   On " . $poster['4'] . " :</b> </div>";
            echo "<table width=\"100%\"><tr><td style=\"text-align:center; font-size:large; padding-bottom:20px; color:#551600\">" . $poster['1'] . " &nbsp <a style=\"font-size:12px;\" href=\"discussion.php?wc=1 & pid=" . $_GET['pid'] . "& curuser=". $_GET['curuser'] . "\">Comment</a> </td></tr>";
            if (isset ($_GET['wc']))
            {
                echo "<tr><td> <div style=\"position:relative; width:50%; left:30%\"> <form name= \"newcomment\" action=\"addcomment.php\" method=\"post\" onsubmit= \"return validatenewcomment()\">
                          <b>Comment</b> :- <textarea name=\"limitedtextarea\" onKeyDown=\"limitText(this.form.limitedtextarea,this.form.countdown,1024);\"
                          onKeyUp=\"limitText(this.form.limitedtextarea,this.form.countdown,1024);\" cols=\"60\" rows=\"2\" style=\"border:5px groove; border-color:#1A446C;\"></textarea><br><br>
                          <input type=\"submit\" name=\"comment\" value=\"Post Comment\" style=\"position:relative; left :1px\" >
                          </div>
                          <div style=\"position:relative; top:-50px; left:510px; width:20%;\">
                            <font size=\"0\">
                            &nbsp Left : <input readonly type=\"text\" name=\"countdown\" size=\"3\" value=\"1024\" style=\"border:0px; background:#CCCCFF\">
                            </font>
                            <input type=\"hidden\" value=\"{$_GET['pid']}\" name=\"pid\">
                          </div>
                          </form>
                        </td>
                        
                        </tr>";
            }
            echo "<tr><td align=\"left\" style=\"padding-bottom:40px; padding-left:200px; padding-right:100px; text-indent:25px; color:#533024; text-wrap:normal\"> - " . nl2br($poster['2']) . "</td></tr></table>";
        ?>
    </div>

    
    
    
   <br><br><br><br><br><br>
    <div>
        <table style="margin-left:47%">
            <tr>
                <td style="text-align:center;padding-left:10px;padding-right:10px;border:4px groove">Comments :-
                </td>
            </tr>
        </table>
    </div>
    
    <br>
    <br>
    
      
    <div>
        <table width="90%" style="margin-left:5%; border-style:ridge;border-color:black;border:5px ridge;padding-top:5px">
            <?php
		$flag=1;
                $comment_set = get_comments_by_postid($_GET['pid']);
                while ($comment = mysql_fetch_array($comment_set))
                {
                    if($flag%2==0)
		    {
			$color="#320032";
			$bcolor=" #D4E6F4";
		    }
		    else
		    {
			$color="#006600";
			$bcolor=" #D4E6F4";
		    }
		    $flag = $flag+1;
		    echo "<tr style=\"color: {$color}; background-color:{$bcolor};\"><td style=\"padding-bottom:30px; padding-left:40px; width:25%\"> " . $comment['3'] . "<br> &nbsp&nbsp " . $comment['4'] . "</td>";
                    echo "<td> {$comment['2']} </td>";
                    echo "<td>";
                    //echo $comment['3'] . "";
                    if ($comment['3'] == $_SESSION['user_id'] || (isset($_SESSION['admin']) && $_SESSION['admin'] == "t"))
                    {
                        echo "<a href=\"delete.php?cid={$comment['0']} & pid={$_GET['pid']}\">Delete</a> " . " </td></tr>";
                    }
                    else
                    {
                        echo " </td></tr>";
                    }
                    
                }
            ?>
        </table>
    </div>
    

    <button onClick="window.location='noticeboard.php'" style="margin-left:48%">Back home!</button>
     

<?php
    include("includes/footer.php");
?>