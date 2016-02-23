/*<?php
    /*if($_FILES['file']['error']>0){
      exit("error");
    }
    
    move_uploaded_file($_FILES['file']['tmp_name'],'upfile/'.$_FILES['file']['name']);
    echo "upload success";
    header('refresh:2;url=./album.php');
    //echo '<a href="upfile/'.$_FILES['file']['name'].'">upfile/'.$_FILES['file']['name'].'</a>';*/
    $p_albumid = $_POST['albid'];
    $p_albumna = $_POST['albna'];
    
    $host = "127.0.0.1";
	$dbname = "web_final_db";
	$user = "root";
	$pass = "";
    

if(isset($_FILES['files'])){
    $errors= array();
 foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
  $file_name = $_FILES['files']['name'][$key]; 
  $file_size =$_FILES['files']['size'][$key];
  $file_tmp =$_FILES['files']['tmp_name'][$key];
  $file_type=$_FILES['files']['type'][$key]; 
        if($file_name == ""){
            header('refresh:2;url=./photos.php?palid='. $p_albumid .'&palna='. $p_albumna);
            exit("error");
        }
        $desired_dir="upfile";
        if(empty($errors)==true){
            if(is_dir($desired_dir)==false){
                mkdir("$desired_dir", 0700);  // Create directory if it does not exist
            }
            if(is_dir("$desired_dir/".$file_name)==false){
                move_uploaded_file($file_tmp,"upfile/".$file_name);
                try {
		              $db = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass);
		              $db->exec("INSERT INTO photo(album_id,photo_url)VALUES('$p_albumid','upfile/".$file_name."')");
                      $db->exec("UPDATE album SET album_pic='upfile/". $file_name ."' WHERE album_id='".$p_albumid."'");
	            }
	            catch(PDOException $e) {
		              echo $e->getMessage();
	            }
	            $conn = null;
            }else{         //rename the file if another one exist
                $new_dir="upfile/".$file_name.time();
                 rename($file_tmp,$new_dir) ;    
                try {
		              $db = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass);
		              $db->exec("INSERT INTO photo(album_id,photo_url)VALUES('$p_albumid','upfile/".$file_name."')");
                      $db->exec("UPDATE album SET album_pic='upfile/". $file_name ."' WHERE album_id='".$p_albumid."'");
	            }
	            catch(PDOException $e) {
		              echo $e->getMessage();
	            }
	            $conn = null;     
            }
            
        }else{
                print_r($errors);
        }
    }
 if(empty($error)){
    echo "upload success".$p_albumid;
    header('refresh:2;url=./photos.php?palid='. $p_albumid
                                    .'&palna='. $p_albumna);
 }
}
?>