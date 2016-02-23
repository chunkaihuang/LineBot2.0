<?php if(!isset($_COOKIE["haslogin"])){
        header("Location: ./index.php");
        }?>
        
<?php
	$host = "127.0.0.1";
	$dbname = "web_final_db";
	$user = "root";
	$pass = "";

    $p_val_usern = $_COOKIE["haslogin"];
    $p_val_userid = $_COOKIE["idofuser"];
	
	try {
		$db = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass);

		$stmt = $db->prepare("SELECT album_name, album_id, album_pic FROM album WHERE user_id = '$p_val_userid'");
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
      a {
        color:#191970;
      }
      .jumbotron {
        background-color:rgba(192,192,192,0.6);
      }
     </style> 
     <script type="text/javascript" src="./css/jquery-1.2.6.js"></script>
     <script type="text/javascript">
     $(document).ready(function () {
         $('#bt_submit').click(function (){
             $.ajax({
                url: 'pdo_newalbum.php',
                cache: false,
                dataType: 'html',
                    type:'GET',
                data: { p_albumn: $('#_id_alna').val()},
                error: function(xhr) {
                alert('invalid request');
                },
                success: function(response) {
                window.location.reload("./album.php")
                }
            });
            
            if($('#_id_alna').val() == "")
                alert('Please name your new album');
        });
        })
     </script>
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
        <p>Create a new album</p>
        
        <form class="form-signin" action="pdo_newalbum.php" method="post">
            <input type="text" id="_id_alna" name="p_albumn" placeholder="Your ablum name" autofocus="">
            <input type="button" value="Submit (Ajax)" id="bt_submit">
          <!-- <input class="pure-button pure-button-primary" id="submit" name="submit" type="submit" value="Submit"> -->
        </form>
        
      </div>

    </div>   
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Albums
                </h1>
            </div>
        </div>
        
        <?php 
            $p_val_num = 0;
            
            if ( count($records) > 0) {
			         foreach ($records as $rec) {
				        if ($rec[0] != null) {
                            if ($p_val_num == 0) {
                                echo '<div class="row">';
                            }
                            
                            echo 
                                '<div class="col-md-4 portfolio-item">
                                    <a href="photos.php?palid='. $rec[1]
                                    .'&palna='. $rec[0].
                                    '">
                                        <img class="img-responsive" src="'. $rec[2]
                                        .'" width="400"  alt="">
                                    </a>
                                    <h3>
                                        <a href="photos.php?palid='. $rec[1]
                                        .'&palna='. $rec[0].
                                        '">'
                                        . $rec[0]
                                        .
                                        '</a>
                                    </h3>
                                </div>';
                            $p_val_num = $p_val_num + 1;
                            if ($p_val_num == 3) {
                                $p_val_num = 0;
                                echo '</div>';
                            }
                        }
                        else
                            echo '</div>';
			         }
		         }
        ?>

    </div>

    <script src="./css/jquery.min.js"></script>
    <script src="./css/bootstrap.min.js"></script>
    <script src="./css/ie10-viewport-bug-workaround.js"></script>
  
</body></html>