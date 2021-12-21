<?php
   session_start() ;
   require_once "./auth.php" ;
      
   if ( !empty($_POST)) {
     extract($_POST) ;
     require_once "./db.php" ;
     require_once "./Upload.php" ;
     $upload = new Upload("profile", "images");

     $rs = $db->prepare("insert into user (name, email, password, bday, profile) values (?,?,?,?,?)") ;
     $rs->execute([$username, $email, password_hash($password, PASSWORD_DEFAULT), $bday, $upload->file()]);

     // redirect browser to index.php
     header("Location: index.php") ;
     exit ;
   }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Title of the document</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <style>
     .container { margin-top: 100px;}
     .input-field { width: 60%; margin: 30px auto;}
    </style>
  </head>
  <body>
  <nav>
    <div class="nav-wrapper">
      <a href="index.php" class="brand-logo">Bookmark</a>
    </div>
  </nav>
  <div class="container">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="input-field">
          <input name="username" id="username" type="text" class="validate">
          <label for="username">Name Lastname</label>
        </div>

        <div class="input-field">
          <input name="email" id="email" type="text" class="validate">
          <label for="email">Email</label>
        </div>

        <div class="input-field">
          <input name="password" id="password" type="text" class="validate">
          <label for="password">Password</label>
        </div>

        <div class="input-field">
          <input name="bday" id="bday" type="text" class="validate">
          <label for="bday">Birthday</label>
        </div>

        <div class="file-field input-field">
          <div class="btn">
            <span>File</span>
            <input type="file" name="profile">
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" type="text">
          </div>
        </div>

        <div class="center">
          <button class="btn waves-effect waves-light" type="submit" name="action">Register
            <i class="material-icons right">send</i>
          </button>
        </div>
    
    
    </form>
   
  </div>

  <script>
    $(function(){

    })
  </script>
  </body>
</html>