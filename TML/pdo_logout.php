<?php
// set the expiration date to one hour ago
setcookie("haslogin", "", time() - 3600);
echo "You have logged out.";
header('refresh:2;url=./dashboard.php');
?>
<html>
<head>
<meta charset="utf-8" />
<title>logging out</title>
<script language="Javascript">
	//var speed = 2000;
	//setTimeout("goto()", speed);
	//location = "./dashboard.html";
	//alert("hello");
	/*function goto() 
	{
    	location = "./dashboard.php";
	}*/
</script>
</head>
<body>
</body>
</html>