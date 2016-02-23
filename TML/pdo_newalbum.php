<?php
	$host = "127.0.0.1";
	$dbname = "web_final_db";
	$user = "root";
	$pass = "";

	$p_val_userid = $_COOKIE["idofuser"];
	$p_albumn = $_GET['p_albumn']; 

    if($p_albumn==""){
      header('refresh:2;url=./album.php');  
      exit("invalid request");
    }	

	try {
		$db = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass);

		$stmt = $db->prepare("SELECT * FROM user WHERE user_id = '$p_val_userid'");
		$stmt->execute();
		$records = $stmt->fetchALL();

		//if ( count($records) == 0) {
			$affectedRowCount = $db->exec("INSERT INTO album(user_id,album_name)VALUES('$p_val_userid','$p_albumn')");
			echo "Create success";
			header('refresh:1;url=./album.php');
		//}
		//else {
			//echo "album name exist";
		//}

	}
	catch(PDOException $e) {
		echo $e->getMessage();
		//require "error.html";
	}

	$conn = null;
?>

<html>
<head>
<meta charset="utf-8" />
<title>Resgister</title>
</head>
<body>
	<div>
        
    </div>
</body>
</html>