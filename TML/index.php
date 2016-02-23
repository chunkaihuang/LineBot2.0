<?php if(isset($_COOKIE["haslogin"])){
        header("Location: ./dashboard.php"); 
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

    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/jumbotron.css" rel="stylesheet">

    <script src="./css/ie-emulation-modes-warning.js"></script>

    <style>
      body {
        margin: 0;
        background-color: azure;
        background-image: url("./image/FenwayPark.png");
        background-repeat: no-repeat;
        background-attachment: fixed;
      }
      .jumbotron {
        background-color:rgba(80,80,80,0.9);
      }
      mh1 {
        font-size: 4em;
        color: #D8D8D8;
      }
      mp1 {
        font-size: large;
        color: #C0C0C0;
      }
      .smalljum {
        background-color:rgba(230,230,230,0.9);
        border-radius:10px;
        padding: 3px 10px 10px 10px;
      }
     </style>
    
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="./index.php">TeamMember Linker</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <form class="navbar-form navbar-right" method="POST" action="pdo_login.php">
            <div class="form-group">
              <input type="text" name="p_username" placeholder="Username" class="form-control">
            </div>
            <div class="form-group">
              <input type="password"  name="p_password"  placeholder="Password" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Sign in</button>
            <a href="./page_register.php">Register</a>
            <a href="./page_reset.php">ResetPW</a>
          </form>
        </div>
      </div>
    </nav>

    <div class="jumbotron">
      <div class="container">
        <mh1>Hello, members!</mh1><br>
        <mp1>This website is designed for team members to contact each other. It combine several features such as 
           communication, photo shareing and Paypal function. By using TeamMember Linker, 
           interaction of a team become easier and closer.</mp1>
      </div>
    </div>


    <div class="container">
      <div class="row">
        
        <div class="col-md-4">
          <div class="smalljum">
          <h2>Communication</h2>
          <p>Discuss team stuff by using message board.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="smalljum">
          <h2>Sharing</h2>
          <p>Upload and share your photos and experience.</p>
          </div>
       </div>
        <div class="col-md-4">
          <div class="smalljum">
          <h2>Shopping</h2>
          <p>Purchase and manage the money of your team.</p>
          </div>
        </div>
      </div>
    </div> 
    <script src="./css/jquery.min.js"></script>
    <script src="./css/bootstrap.min.js"></script>
    <script src="./css/ie10-viewport-bug-workaround.js"></script>
  

</body></html>