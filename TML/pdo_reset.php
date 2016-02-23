<?php
	$host = "127.0.0.1";
	$dbname = "web_final_db";
	$user = "root";
	$pass = "";
	$ed_key = "aplus";

	$p_username = $_GET['p_username']; 
	$p_password = $_GET['p_password']; 

	try {
		$db = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass);

		$stmt = $db->prepare("SELECT * FROM user WHERE user_name = aes_encrypt('" .$p_username. "', 'aplus')");
		$stmt->execute();
		$records = $stmt->fetchALL();
		if ( count($records) > 0) {
			foreach ($records as $rec) {
				$affectedRowCount = $db->exec("UPDATE user SET password=aes_encrypt('" .$p_password. "', 'aplus') WHERE user_id= $rec[0]");
				echo "Reset success";
				header('refresh:2;url=./index.php');
			}
		}
		else {
			echo "wrong username";
		}

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
        <a href="./index.php">Back to homepage</a><br>
    </div>
</body>
</html>