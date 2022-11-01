<?php
       $servername = "localhost";
       $username = "root";
       $password = "";
       $dbname = "calculator";

       $connection = mysqli_connect($servername, $username, $password, $dbname);
       
       if($connection){
            //echo "Connected succssfully";
       }else{
        die("Error");
       }
       
       
     //   function confirmQuery($result){
     //      global $connection;
     //      if(!$result){
     //           die('connection failed'. mysqli_error($connection));
     //      }
     //   }


       
?>