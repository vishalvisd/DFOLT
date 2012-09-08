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
    
    function validatenewpost()
    {
	var x=document.forms["newpost"]["Title"].value
	var y=document.forms["newpost"]["limitedtextarea"].value
	if (x==null || x=="" || y==null || y=="" ) 
	  {
	      alert("Title or Post box cannot be empty");
	      return false;
	  }
    }

        </script>
   
</head>
<body>
    <div id="container">
        <div id="header">
            <h1>DFOLT</h1>
            <p style="text-align:right; margin-top:-20px; margin-right:10px; color:black">
		 <script language = "JavaScript">
		         var now = new Date();
		         var dayNames = new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
		         var monNames = new Array("January","February","March","April","May","June","July","August","September","October","November","December");
		         document.write(dayNames[now.getDay()] + " " + monNames[now.getMonth()] + " " + now.getDate() + ", " + now.getFullYear());
		 </script>
            </p>
        </div>
        <div id="header1" style="margin-top:-20px">
            <ul> 
                <li>
                    <a href="logout.php" style="font-size:20px;">Logout</a>
                </li>
            </ul>
             <?php
                if ($_SESSION['user_sex'] == "f")
                {
                    $sex = "Ms." ;
                }
		else if ($_SESSION['user_sex'] == "m")
                {
                    $sex = "Mr.";
                }
                else
                {
                    $sex = "";
                }
                echo "<p style=\"text-align:left; margin-left:10px;color:#D4E6F4\">Welcome to Notice board " . "<b>{$sex} " .  $_SESSION['user_name'] . "</b> <br> Howzz ya !</p>";
                if (isset($_SESSION['admin']) && $_SESSION['admin'] == "t")
                {
                    echo " <br> <br><div style=\" font-size:xx-small; color:black; padding:3px; position:relative; left:6px; top:1px;\"><br><p> &nbsp&nbsp&nbsp LOGGED AS ADMIN </p></div>";
                    $admin= 1;	
		}
		else
                {
                    $admin= 2;
                }
            ?>
	</div>
        <div>
	    <?php $curuser = $_SESSION['user_name']; ?>
            <p style="margin-left:10px">Username : <?php echo $curuser; ?> </p>
	    <p style="margin-left:10px">Last Login : <?php echo $_SESSION['last_login']; ?>
	</div>
  
   
        <div style="position:relative; top:20px;left:2%;width:30%;border-style:ridge;border-color:grey">
            <p style="text-align:center"><b> UPLOAD DOCUMENTS</b><br></p>
            <form action="uploader.php" method="post"enctype="multipart/form-data">
                <label for="file">Filename:</label>
                <input type="file" name="file" id="file"  size="10px" style="background:#D4E6F4"/>
                <br />
                <br>
                <div style="width:20%;">Select a Category:</div><div style="width:40%; position:relative; left:20%;top:-30px"><select name="myselect" style="background:#D4E6F4">
                    <option value="Circular">Circular</option>
                    <option value="Notice">Notice</option>
                    <option value="Notes">Notes</option>
                    </select>
                </div>
                <br>
                <div>
                <?php
                    if (isset($_GET['up']))
                    {
                            
                        if ($_GET['up']=="rpt")
                        {
                            echo "Info : File already exists...";
                        }
                        if ($_GET['up']== "ok")
                        {
                            echo "Info : File Succesfully uploaded...";
                        }
                        if ($_GET['up']== "invalid")
                        {
                            echo "Info : File not saved. This Format is not allowed...";
                        }
                            
                    }
                ?>
                </div>
                    
                <p style="position:relative;top:-88px;left:60%;width:40%;"><input type="submit" name="submit" value="UPLOAD" size="-2px" style="height:40px" /></p>
            </form>
            <div style="position:absolute;left:65px;top:185px; border:2px outset;padding:2px;">
                <a href="docs.php" style="font-size:medium; color:darkred"> &nbsp&nbsp Go to Docs &nbsp&nbsp </a>
            </div>
        </div>

        
       
        <div style="position:relative; left:400px; width:50%; top:-230px">
            <form name="newpost" action="post.php" method="post" onsubmit= "return validatenewpost()">
               <b> Tilte </b>:- <br> <input type="text" maxlength=100 name="Title" value="" style="width:400px; border:3px solid;border-color:#1A446C; color:brown;background:#D4E6F4"><br><br>
                <b>Post</b> :-<br><textarea name="limitedtextarea" onKeyDown="limitText(this.form.limitedtextarea,this.form.countdown,1024);"
                          onKeyUp="limitText(this.form.limitedtextarea,this.form.countdown,1024);" cols="60" rows="2" style="border:5px groove; border-color:#1A446C;background:#D4E6F4"></textarea><br><br>
                          <input type="submit" name="Tweet" value="TWEET" style="position:relative; left :520px;width:70px; height:35px; letter-spacing:-2px;top:-50px; color:blue" >
                
                 
       </div>
       <div style="position:relative;left:650px;top:360px;width:50%">
            <font size="0">
                &nbsp Left : <input readonly type="text" name="countdown" size="3" value="1024" style="border:0px; background:#CCCCFF"> </font>
            </form>      
       </div>
  
        <br>
        <div>
	    <?php
		if (isset($_SESSION['admin']) && $_SESSION['admin']=="t")
		{
		   echo "<div style=\"position:relative;left:840px;top:-300px\">" . " &nbsp&nbsp&nbsp&nbsp " . "<a href=\"edituser.php\" style=\"font-size:20px\">Edit Users</a> </div>";
		    
		}
	    ?>
        </div>
        <div style="border:5px solid grey; width:75%;position:relative;left:80px;padding:5%;margin-top:-90px; border-style:ridge; border-color:#B8B8B8; background:#D8D8D8 ">
            <div style="position:absolute;top:4px;width:90%;magin-left:200px; text-align:center">
                <p> <h2>RECENT HOT TOPICS :- </h2></p><p style="text-align:right; margin-right:150px">&nbsp&nbsp&nbsp<a href="noticeboard.php?sa=1">See All</a></p>
            </div>

            <div style="width:100%; margin-top:1px; margin-left:2px">
                <table style="table-layout:fixed; margin-top:30px" width=100% >
                <col width=3>
                <col width=20>
                <col width=12>
            	<col width=5>
                <col width=57>
                <col width=3>
                <th align="center"></th>
                <th align="left">User ID</th>
                <th align="center">Date</th>
                <th align="center"></th>
                <th align="center">Topic</th>
        
           
            
        
                <?php
                    if (isset ($_GET['sa']))
                    {
                        $result_set = recent_post();
                    }
                    else
                    {
                        $result_set = recent_post(2);
                        
                    } 
                    $count=1;
                    while ($post_id1 = mysql_fetch_array($result_set))
                        {	if($count%2 == 0){
                                $color="#D4E6F4";
                                }
                                else{
                                    $color="#CCCCFF";
                                }
                                $post_row = mysql_fetch_array (getdetail($post_id1[0]));
                                $no_ofcomments= get_no_of_comments($post_row[4]);
                                echo "<tr style=\"background-color:{$color}\"> <td> </td> <td >" . " &nbsp&nbsp " . $post_row[0] ."</td>" . "<td >   " . $post_row[3] . "</td><td></td><td>" . "<a href=\"discussion.php?pid={$post_row[4]} & curuser= {$curuser}\"> {$post_row[1]} </a>  ({$no_ofcomments})";
                                if ($post_row['0'] == $_SESSION['user_id'] || $admin==1 )
                                {
                                    echo "<td> <a href=\"delete.php?pid={$post_row[4]}\"> X </a> </td>";
                                }
                                else
                                {
                                    echo "<td></td>";
                                }
                                echo " </td></tr>";
                                $count=$count+1;
		    
                        }
                ?>
                </table>
                <br><br><br><br><br>
            </div>
        </div>

<?php
    include("includes/footer.php");
?>