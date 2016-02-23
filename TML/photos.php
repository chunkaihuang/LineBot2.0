<?php if(!isset($_COOKIE["haslogin"])){
        header("Location: ./index.php");
        }
        
        $p_albumid = $_GET['palid']; 
        $p_albumna = $_GET['palna']; 
        
        $host = "127.0.0.1";
        $dbname = "web_final_db";
        $user = "root";
        $pass = "";
        
        	try {
		$db = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass);

		$stmt = $db->prepare("SELECT photo_url FROM photo WHERE album_id = '$p_albumid'");
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
		//require "error.html";
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
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
    <title>TeamMember Linker</title>
    
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/navbar.css" rel="stylesheet">

    <script src="./css/ie-emulation-modes-warning.js"></script>
    <style>
      body {
        margin: 0;
        background-color: azure;
        background-image: url("./image/albumback.JPG");
        background-attachment: fixed;
      }
      .jumbotron {
        background-color:rgba(192,192,192,0.6);
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
          <a class="navbar-brand" href="#">TeamMember Linker</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="./dashboard.php">Home</a></li>
            <li><a href="./messageboard.php">Message</a></li>
            <li class="active"><a href="./album.php">Album</a></li>
            <li><a href="./shopping.php">Shopping</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="./userphoto.php"><?php echo $_COOKIE["haslogin"] ?></a></li>
            <li><a href="./pdo_logout.php">Log out</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container">
      <br><br>
      <div class="jumbotron">
        <p>Upload your photos!!</p>
        
        <form action="upload.php" enctype="multipart/form-data" method="post">
          <input id="file" name="files[]" type="file" multiple>
          <input class="hidden" id="albid" type="text" name="albid" value="<?php echo $p_albumid ?>">
          <input class="hidden" id="albna" type="text" name="albna" value="<?php echo $p_albumna ?>">
          <input class="pure-button pure-button-primary" id="submit" name="submit" type="submit" value="Start upload!!">
        </form>
        
      </div>

    </div>

    <div class="container">

        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header"><?php echo $p_albumna ?></h1>
            </div>

            <?php
            $p_val_num = 0;
            if ( count($records) > 0) {
			         foreach ($records as $rec) {
				        if ($rec[0] != null) {
                  if ($p_val_num == 0) {
                    echo '<div class="row">';
                  }
                  echo '
                    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                    <a class="thumbnail" href="./'.
                    $rec[0]
                    .'" target="_blank">
                    <img class="img-responsive" src="./'.
                    $rec[0]
                    
                    .'" width="200" alt="">
                    </a>
                    </div>
                  ';
                  $p_val_num = $p_val_num + 1;
                  if ($p_val_num == 4) {
                    $p_val_num = 0;
                    echo '</div>';
                  }
                }
               }
            }
            ?>
            
        </div>

    </div>

    <script src="./css/jquery.min.js"></script>
    <script src="./css/bootstrap.min.js"></script>
    <script src="./css/ie10-viewport-bug-workaround.js"></script>
  
</body></html>