<?php include ("includes/session.php");
?>
<html lang="en">
    <head>
        <title>DFOLT</title>
        <link href="stylesheets/public.css" rel="stylesheet" media="all" style="text/css" />
        
   
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
		     
                     Username : <?php echo $_SESSION['user_name']; ?>
                     
                </td>
                
            </tr>
            
        </table>
    </div>
    <div id="header1">
	<ul style="margin-right:60px;">
	    <li><a style="color:blue" href="noticeboard.php">Back &nbsp&nbsp&nbsp&nbsp </a></li>
	    <li style="border-right:0px none !important; border-color:white"><a href="logout.php"> &nbsp&nbsp&nbsp&nbsp Logout</a></li>
	</ul>
		
    </div>

   
<?php
$dir = "docs/";

// Open a known directory, and proceed to read its contents
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        echo "<div style=\"position:relative; width:80%;height:70%;margin-top:30px;margin-left:10%; margin-bottom:10px;border:5px; border-style:ridge; border-color:grey; background:#CCCCCC\"><div style=\"text-align:center; width:50%;margin-left:20%\"><p><h3>DOCS</h3>Click on a File Name to Download Now!</p></div><table style=\"border:3px solid;margin-left:10%; margin-top:30px;width:80%\"> <col width=5>
        <col width=5><col width=80><th align=\"left\">User</th><th align=\"left\">Category</th><th align=\"left\">File</th>";
        while (($file = readdir($dh)) !== false) {
	    
            //echo "<br>" . $file;
            echo "<tr style=\"border:3px solid;\">";
            $pieces = explode('.', $file);
            $morePieces = explode('_', $pieces[0]);
            if (isset($morePieces[0]))
            {
                $u = $morePieces[0];
                //echo $u;
            }
            else {$u="";}
            if (isset($morePieces[1]))
            {
                $cat = $morePieces[1];
               // echo $cat;
            }
            else {$cat="";}
            if (isset($morePieces[2]))
            {
                $fname = $morePieces[2];
                //echo $fname;
            }
            else {$fname="";}
            
            echo "<td > {$u}</td> <td> {$cat} </td><td><a href=download.php?f=" . urlencode($file). "&fc=" . urlencode($fname) . "." . "{$pieces[1]}" . ">{$fname}</a></td></tr>" ;
        }
        echo "</table></div>";
        closedir($dh);
    }
    
    

}
else
{
    echo "directory not found";
}
?>
    
<?php
    include("includes/footer.php");
?>
         
