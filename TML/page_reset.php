<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./image/Group_icon.png">

    <title>Signin Template for Bootstrap</title>

    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/signin.css" rel="stylesheet">

    <script src="./css/ie-emulation-modes-warning.js"></script>

    <script type="text/javascript" src="./css/jquery-1.2.6.js"></script>
    <script type="text/javascript">
    $(document).ready(function () {
        $('#bt_submit').click(function (){
            $.ajax({
              url: 'pdo_reset.php',
              cache: false,
              dataType: 'html',
                  type:'GET',
              data: { p_username: $('#_iduser').val(), p_password: $('#_idpw').val()},
              error: function(xhr) {
              alert('invalid request');
              },
              success: function(response) {
              window.location.replace("./index.php");
              alert('Reset success');
              }
          });
      });
      })
    </script>
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

    <div class="container">

      <form class="form-signin" method="POST" action="pdo_reset.php">
        <h2 class="form-signin-heading">Reset your password</h2>
        <label for="inputUser" class="sr-only">Username</label>
        <input type="text" id="_iduser" name="p_username" class="form-control" placeholder="Username" required="" autofocus="">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="_idpw" name="p_password" class="form-control" placeholder="New Password" required="">

        <input class="btn btn-lg btn-primary btn-block" type="button" value="Submit (Ajax)" id="bt_submit">
      </form>

    </div> 

    <script src="./css/ie10-viewport-bug-workaround.js"></script>
  
</body></html>