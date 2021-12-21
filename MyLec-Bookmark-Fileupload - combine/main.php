<?php
  session_start() ;
   require_once "./protect.php" ;
  
  
  $user = $_SESSION["user"] ;
  // var_dump($user) ;

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
      .container { margin-top: 50px;}
      .circle { vertical-align: middle;}
      html, body { height: 100%;}
      section {height: 100%;display: flex ; /* section is a flexbox container */flex-direction: column;}
      article {flex-grow: 1; overflow: auto;}
      #message {background: white ; padding: 5px 15px;box-sizing: border-box; }
      .messageBox { padding: 0 15px;}
      li.collection-header { background: #FDD !important; }
      ul.collection { margin-top: 0 ;}
      #nickModal { padding-bottom: 20px;}

    </style>
  </head>
  <body>
  <section>
   <nav>
     <div class="nav-wrapper">
       <a href="index.php" class="brand-logo">Bookmark</a>
       <ul id="nav-mobile" class="right">
         <li>
          <a href="update_profile.php">
           <?php
             $profile = $user["profile"] ?? "avatar.png" ;
             echo "<img src='images/$profile' width='40' class='circle' > " ;
             echo $user["name"] ;
           ?>
           </a>
         </li>
         <li><a href="logout.php">Logout</a></li>
       </ul>
     </div>
   </nav>
  
    <article>
       <table class="striped">
       <thead>
               <tr>
                   <th width="75">Time</th>
                   <th width="125">From</th>
                   <th>Message</th>
               </tr>
       </thead>
       <tbody id="messages"></tbody>
       
       </table>
    </article>
    
    <div class="messageBox red lighten-2">
        <form id="messageForm">
            <div class="input-field">
              <input name="message" id="message" type="text" class="validate" placeholder="Enter a message..">
            </div>
        </form>
    </div>
  
  </section>
    

  <script>
    $(function(){
      var elems = document.querySelector('#nickModal');
        var nickModal = M.Modal.init(elems, {dismissible: false});
        var lastId = 0 ;
        var pollID ;

        // If a nick was not taken before, show a modal dialog box to get a nickname
        var nickLocal = localStorage.getItem("nickLocal") ;
        
        if ( nickLocal == null ) {
            nickModal.open();
            $("#nick").focus() ;
        } else {
            $("#nickNavbar").text(nickLocal) ;
            $("#message").focus() ;
            getMessages();
            pollID = setInterval(getMessages, 2000) ; // get new messages by polling (not a good technique)
        }

        // Nick girdikten sonra girdiğin nicki  gösterme functionı
        $("#nickForm").submit(function(e){
          e.preventDefault();

          let nick = $("#nick").val().trim();
          if ( nick.length === 0) {
            M.toast({html: "Nick cannot be empty!", displayLength : 1000}) ;
            return ;
          }
          // console.log("Nickname is valid : " + nick) ;
          $.post("nicks.php", {nick: nick }, function(result){
              if (result.valid) {
                 localStorage.setItem("nickLocal", result.nick) ;
                 nickModal.close();
                 $("#nickNavbar").text(result.nick) ;
                 $("#message").focus();
                 getMessages() ;
                 pollID = setInterval(getMessages, 2000) ;
              } else {
                M.toast({html: "Nick is in use!", displayLength : 1000}) ;
              }
          })
        })


        // Add a new Message
        $("#messageForm").submit(function(e){
          e.preventDefault();
          let msg = $("#message").val().trim();
          if ( msg.length === 0) {
            M.toast({html: "Message cannot be empty!", displayLength : 1000}) ;
            return ;
          }
          $.post("messages.php", {
             nick : localStorage.getItem("nickLocal"),
             message : msg
          },
          function (result) {
             getMessages();
             $("#message").val("").focus() ;
          }
          )
        })

         // Retrieve new messages.
         function getMessages() {
            $.get("messages.php", { lastId : lastId}, function(data){
                console.log(data) ;
                rows = "" ;
                for ( let msg of data) {
                    rows += `
                        <tr>
                            <td>${msg.time}</td>
                            <td><b>${msg.nick}</b></td>
                            <td>${msg.content}</td>
                        </tr>
                    ` ;
                }
                // console.log(rows) ;
                $("#messages").prepend(rows) ;
                // store the id of the last message downloaded.
                if ( data.length !== 0) lastId = data[0].id ;
            })
         }

    })
  </script>
  </body>
</html>