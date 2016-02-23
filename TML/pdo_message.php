<?php
	$host = "127.0.0.1";
	$dbname = "web_final_db";
	$user = "root";
	$pass = "";

	$p_uname = $_COOKIE["haslogin"];
	$p_tit = $_GET['p_title']; 
	$p_con = $_GET['p_content']; 
	
	try {
		$db = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass);

		$stmt = $db->prepare("SELECT user_id FROM user WHERE user_name = aes_encrypt('" .$p_uname. "', 'aplus')");
		$stmt->execute();
		$records = $stmt->fetchALL();

		if ( count($records) > 0) {
			foreach ($records as $rec) {
				if ($rec[0] != null) {
					$affectedRowCount = $db->exec("INSERT INTO board(user_id,title,content)VALUES('$rec[0]','$p_tit','$p_con')");
					echo "Send success";
					header('refresh:2;url=./messageboard.php');
				}
			}
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