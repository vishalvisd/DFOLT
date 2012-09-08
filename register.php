<html>
<head>
     <link href="stylesheets/index.css" rel="stylesheet" media="all" style="text/css" />
     <script language="javascript" type="text/javascript">
   
    
    function validatejoin()
    {
	var a=document.forms["join"]["name"].value
	var b=document.forms["join"]["age"].value
        //var c=document.forms["join"]["sex"].value
	var d=document.forms["join"]["userid"].value
        var e=document.forms["join"]["password"].value
	
	if (a==null || b=="" || d=="" || e=="" ) 
	  {
	      alert("Please Check field, one or more field empty");
	      return false;
	  }
    }

        </script>
</head>
<body>
<?php
echo "Welcome to Registration :-";
?>
<div  style="position : absolute; top : 15%;  right:5%;border:solid 2px; height:300px; width: 450px; padding:10px">
<form name="join" action="adduser.php" method="post" onsubmit= "return validatejoin()">
    Name :&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" value="" name="name" maxlength="30"><br><br>
    Age :&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" value="" name="age" size="1px" maxlength="3"><br><br>
    Sex :&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="radio" value = "1" name="sex"> Male &nbsp <input type="radio" value = "0" name="sex"> Female <br><br>
    User ID :&nbsp&nbsp&nbsp&nbsp<input type="text" value="" name="userid" maxlength="20"><br><br>
    Password :&nbsp <input type="password" value="" name="password"><br>
    &nbsp&nbsp&nbsp&nbsp<input type="submit" value="JOIN" name="submit">
</form>
</div>
</body>
</html>
    