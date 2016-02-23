<?php 
$host = "127.0.0.1";
$dbname = "web_final_db";
$user = "root";
$pass = "";

$p_username = $_POST['p_username']; 
$p_password = $_POST['p_password']; 

try {
		$db = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass);

		$stmt = $db->prepare("SELECT aes_decrypt(password, 'aplus'), user_id FROM user WHERE user_name = aes_encrypt('" .$p_username. "', 'aplus')");
		$stmt->execute();
		$records = $stmt->fetchALL();

		if ( count($records) > 0) {
			foreach ($records as $rec) {
				if ($rec[0] != null) {
					if ($p_password == $rec[0]) {
						//echo "Wellcome back!! " . $p_username;
						
						//if($p_password == 'pw' && $p_username == 'un'){
            				setcookie("haslogin",$p_username, time()+3600);
							setcookie("idofuser",$rec[1], time()+3600);
							echo "Wellcome back!! " . $p_username;
							header('refresh:2;url=./dashboard.php');
            				//header("Location: ./dashboard.php"); 
    					//} 
						/*echo '<script type="text/javascript">';
						echo 'alert("Wellcome back!! " + "' . $p_username . '");';
						echo 'location = "./dashboard.php";';
						echo '</script>';*/

					}
					else {
						echo '<script type="text/javascript">';
						echo 'alert("Wrong username");';
						echo 'location = "./index.php";';
						echo '</script>';
					}
				}
			}
		}
		else {
					echo '<script type="text/javascript">';
					echo 'alert("Wrong username");';
					echo 'location = "./index.php";';
					echo '</script>';
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
<title>login</title>
<script language="Javascript">
	//var speed = 2000;
	//setTimeout("goto()", speed);
	//location = "./dashboard.html";
	//alert("hello");
	function goto() 
	{
    	location = "./dashboard.php";
	}
</script>
</head>
<body>
</body>
</html>


