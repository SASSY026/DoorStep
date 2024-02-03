<?php
   include('dbconnection.php');
   session_start();

   if(isset($_SESSION['name'])){
     $user_check = $_SESSION['name'];

     $ses_sql = mysqli_query($db,"select Username from login where Username = '$user_check' ");

     $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

     $_SESSION['name'] = $row['Username'];
   }
   else{
    $_SESSION['name'] = "";
   }
?>