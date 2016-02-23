<?php if(!isset($_COOKIE["haslogin"])){
        header("Location: ./index.php");
        }
        
        $p_val_userid = $_COOKIE["idofuser"];
        
        $host = "127.0.0.1";
        $dbname = "web_final_db";
        $user = "root";
        $pass = "";
        
        	try {
              $db = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass);
          
              $stmt = $db->prepare("SELECT aes_decrypt(user_url, 'aplus') FROM user WHERE user_id = '$p_val_userid'");
              $stmt->execute();
              $records = $stmt->fetchALL();
          
              if ( count($records) > 0) {
                foreach ($records as $rec) {
                  if ($rec[0] != null) {
                  }
                }
              }
          
          
            }
            catch(PDOException $e) {
              echo $e->getMessage();
            }
          
            $conn = null;
        
        ?>
<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./image/Group_icon.png">

    <title>TeamMember Linker</title>
    
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/navbar.css" rel="stylesheet">
    <script src="./css/ie-emulation-modes-warning.js"></script>
    <style>
      body {
        margin: 0;
        background-color: azure;
        background-image: url("./image/coff.JPG");
        background-repeat: no-repeat;
        background-attachment: fixed;
      }
      .jumbotron {
        background-color:rgba(192,192,192,0.8);
      }
      .container {
          
      }
     </style>  
  </head>

  <body>

    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="./dashboard.php">TeamMember Linker</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="./dashboard.php">Home</a></li>
            <li><a href="./messageboard.php">Message</a></li>
            <li><a href="./album.php">Album</a></li>
            <li><a href="./shopping.php">Shopping</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="./userphoto.php"><?php echo $_COOKIE["haslogin"] ?></a></li>
            <li><a href="./pdo_logout.php">Log out</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container">
      <div class="row">
        <br><br><br><br>
        </div>
      <div class="col-md-3">
        </div>
      <div class="col-md-6">
      <div class="jumbotron">
        <?php echo'
        <img class="img-responsive" src="./'.
                    $rec[0]
                    .'" width="150" alt="">
        '?>            
        <p>Upload and change your photos!!</p>
        
        <form action="userupload.php" enctype="multipart/form-data" method="post">
          <input id="file" name="file" type="file">
          <input class="hidden" id="useid" type="text" name="useid" value="<?php echo $p_val_userid ?>">
          <input class="pure-button pure-button-primary" id="submit" name="submit" type="submit" value="Change your photo!!">
        </form>
        
      </div>
      </div>

    </div>

    <script src="./css/jquery.min.js"></script>
    <script src="./css/bootstrap.min.js"></script>
    <script src="./css/ie10-viewport-bug-workaround.js"></script>
  
</body></html>