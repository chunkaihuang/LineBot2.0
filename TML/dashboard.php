<?php if(!isset($_COOKIE["haslogin"])){
        header("Location: ./index.php");
        }?>
<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./image/Group_icon.png">

    <title>TeamMember Linker</title>
    
    <script type="text/javascript" src="./css/jquery-1.2.6.js"></script>
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/navbar.css" rel="stylesheet">
    <script src="./css/ie-emulation-modes-warning.js"></script>
    <style>
      body {
        margin: 0;
        background-color: azure;
        background-image: url("./image/TeamWork.jpg");
        background-repeat: no-repeat;
        background-position: center top;
        padding-bottom:10px;
        border: 1px solid 000000; 
      }
      p {
        position: relative;
        top: 250px;
        text-align: center;
        color: #F0F0F0;
        font-family:"Droid Serif","Helvetica Neue",Helvetica,Arial,sans-serif;
        font-style:italic;
        font-size:40px;
        line-height:40px;
        margin-bottom:25px
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
            <li class="active"><a href="./dashboard.php">Home</a></li>
            <li><a href="./messageboard.php">Message</a></li>
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

    <header>
        <div class="container">
            <div>
                <br><br>
                <p>Welcome back, <?php echo $_COOKIE["haslogin"] ?></p>
            </div>
        </div>
    </header>

    <script src="./css/jquery.min.js"></script>
    <script src="./css/bootstrap.min.js"></script>
    <script src="./css/ie10-viewport-bug-workaround.js"></script>
  
</body></html>