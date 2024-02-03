<?php
   session_start();

   if(session_destroy()) {
      header("Location: website.php");
   }
?>

<!-- <button class="btn btn-default text-danger" name="' . $row["workerid"] . '">Cancel</button> -->