<?php
	$host = "127.0.0.1";
	$dbname = "web_final_db";
	$user = "root";
	$pass = "";
	$ed_key = "aplus";

	$p_username = $_POST['p_username']; 
	$p_password = $_POST['p_password']; 
	$p_email = $_POST['p_email']; 

	try {
		$db = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass);

		$stmt = $db->prepare("SELECT * FROM user WHERE user_name = aes_encrypt('" .$p_username. "', 'aplus')");
		$stmt->execute();
		$records = $stmt->fetchALL();
 
		if ( count($records) == 0) {
			$affectedRowCount = $db->exec("INSERT INTO user(user_name,password,email,user_url)VALUES(aes_encrypt('" .$p_username. "', 'aplus'),aes_encrypt('" .$p_password. "', 'aplus'),aes_encrypt('" .$p_email. "', 'aplus'),aes_encrypt('./image/blank_user.png', 'aplus'))");
			echo "Register success";
			header('refresh:2;url=./index.php');
		}
		else {
			echo "username exist";
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
    </div>
</body>
</html>