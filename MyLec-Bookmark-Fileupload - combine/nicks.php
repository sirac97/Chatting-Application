<?php

   // REST Web Service for messages table/resource
   require "./db.php" ;
   header("Content-Type: application/json") ; // return data in json format

   if ( $_SERVER["REQUEST_METHOD"] == "POST") {
       $response = addNewNick($_POST["nick"]);
   }

   if ( $_SERVER["REQUEST_METHOD"] == "DELETE") {
    $requestData = file_get_contents("php://input") ; // data part of the http request packet.
    parse_str($requestData, $_DELETE) ;  // convert url encoded string to associative array
    $response = delNick($_DELETE["nick"]);
   }

   echo json_encode($response) ; // send response in json format.




   // Implemantation of Web Service End Points
   function delNick($nick) {
       global $db ;
       $stmt = $db->prepare("delete from nickinuse where nick = ?") ;
       $stmt->execute([$nick]);
       return ["valid" => true] ;
   }


   function addNewNick($nick) {
       global $db ;
       try {
           $stmt = $db->prepare("insert into nickinuse (nick) values (?)") ;
           $stmt->execute([$nick]) ;
           return ["valid" => true, "nick" => filter_var($nick, FILTER_SANITIZE_STRING)] ;
       } catch(PDOException $ex) {
           return ["valid" => false] ;
       }
   } 