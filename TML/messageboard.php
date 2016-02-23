<?php if(!isset($_COOKIE["haslogin"])){
        header("Location: ./index.php");
        }
        
        $host = "127.0.0.1";
        $dbname = "web_final_db";
        $user = "root";
        $pass = "";
        
        try {
		$db = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass);

		$stmt = $db->prepare("SELECT user_id, title, content, post_time FROM board");
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
        background-image: url("./image/sky.jpg");
        background-repeat: no-repeat;
        background-attachment: fixed;
      }
     </style>   
     <script type="text/javascript" src="./css/jquery-1.2.6.js"></script>
     <script type="text/javascript">
     $(document).ready(function () {
         $('#bt_submit').click(function (){
             $.ajax({
                url: 'pdo_message.php',
                cache: false,
                dataType: 'html',
                    type:'GET',
                data: { p_title: $('#mess_title').val(), p_content: $('#mess_cont').val()},
                error: function(xhr) {
                alert('invalid request');
                },
                success: function(response) {
                window.location.reload("./messageboard.php")
                alert('Post success');
                }
            });
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
            <li class="active"><a href="./messageboard.php">Message</a></li>
            <li><a href="./album.php">Album</a></li>
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

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Message board
                </h1>
            </div>
        </div>

        <?php
            if ( count($records) > 0) {
			         foreach ($records as $rec) {
				        if ($rec[0] != null) {
                            
                            try {
                                $db = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass);

                                $stmt = $db->prepare("SELECT aes_decrypt(user_name, 'aplus') , aes_decrypt(user_url, 'aplus') FROM user WHERE user_id ='". $rec[0] ."'");
                                $stmt->execute();
                                $userrecord = $stmt->fetchALL();
                        
                                if ( count($userrecord) > 0) {
                                    foreach ($userrecord as $userrec) {
                                        if ($userrec[0] != null) {
                                            
                                        }
                                    }
                                }
                        
                            }
                            catch(PDOException $e) {
                                echo $e->getMessage();
                            }
                        
                            $conn = null;
                            
                  echo '
                    <div class="row">
                    <div class="col-md-2">
                    <a href="#">
                        <img class="img-responsive" src="./'.
                            $userrec[1]
                        .'" width="100" alt="">
                    </a>
                    </div>
                    <div class="col-md-10">
                        <h3>'. $rec[1]. '</h3>
                        <h4>by: ' . $userrec[0] . ' (' . $rec[3] . ')</h4>
                        <p>'. $rec[2] . '</p>
                    </div>
                    </div>

                    <hr>
                    
                  ';
                }
               }
            }
        ?>

    </div>
    

    <div class="container">

      <form class="form-signin" method="POST" action="pdo_message.php">
        <h2 class="form-signin-heading">New message</h2>
      
        <label for="inputUser" class="sr-only">title</label>
        <input type="text" id="mess_title" name="p_title" placeholder="title" autofocus="">
        <br>
        <label for="inputPassword" class="sr-only">content</label>
        <textarea rows="4" cols="50" name="p_content" id="mess_cont"></textarea>
        <!--<button type="submit">Submit</button>-->
        <input type="button" value="Submit (Ajax)" id="bt_submit">
      </form>

    </div> 

    <script src="./css/jquery.min.js"></script>
    <script src="./css/bootstrap.min.js"></script>
    <script src="./css/ie10-viewport-bug-workaround.js"></script>
  

</body></html>