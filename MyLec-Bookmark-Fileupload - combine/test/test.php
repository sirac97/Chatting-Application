<?php
   if (!empty($_POST)) {
    //  var_dump($_FILES) ;
    require_once "./Upload.php" ;
    $upload = new Upload("profile", "images") ;
    
    var_dump($upload) ;
    if ( $upload->error()) {
        echo "<p>Error : " , $upload->error() , "</p>" ;
    } else {
        echo "<p>File ( ", $upload->file() , ") Uploaded</p>" ;
    }

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
    </style>
  </head>
  <body>
  <div class="container">
    <h5 class="center">File Upload Development</h5>
    <form action="" method="post" enctype="multipart/form-data">
      
        <div class="file-field input-field">
          <div class="btn">
            <span>File</span>
            <input type="file" name="profile">
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" type="text">
          </div>
        </div>

        <button class="btn waves-effect waves-light" type="submit" name="action">Upload
          <i class="material-icons right">send</i>
        </button>

    </form>
  </div>


  </body>
</html>