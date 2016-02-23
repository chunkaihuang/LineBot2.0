/*<?php

    $host = "127.0.0.1";
	$dbname = "web_final_db";
	$user = "root";
	$pass = "";
    
    $p_userid = $_POST['useid'];

    if($_FILES['file']['error']>0){
      header('refresh:2;url=./userphoto.php');  
      exit("error");
    }
    
    move_uploaded_file($_FILES['file']['tmp_name'],'upfile/'.$_FILES['file']['name']);
        try {
                $db = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass);
                $db->exec("UPDATE user SET user_url=aes_encrypt('upfile/". $_FILES['file']['name'] ."', 'aplus') WHERE user_id='".$p_userid."'");
        }
        catch(PDOException $e) {
                echo $e->getMessage();
        }
        $conn = null;
    echo "upload success";
    header('refresh:2;url=./dashboard.php');
    

?>