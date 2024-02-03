<?php
include("session.php");
$sql = "SELECT * FROM worker";
$result = mysqli_query($db, $sql);
if($_SERVER["REQUEST_METHOD"] == "POST"){
  if(isset($_POST["submit"])){
    if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)) {   
        $currworkerid = $row["workerid"];
        if(isset($_POST[$currworkerid])){
          $insertsql =  "DELETE FROM `worker` WHERE `worker`.`workerid` = $currworkerid";
          $res = mysqli_query($db, $insertsql);
        }
      }
    }
  }
  header("Refresh:0");
}
function printTable(){
    $sr = 1;
    global $result;
    if (mysqli_num_rows($result) > 0) {
        echo '
        <button class="btn btn-primary" onclick="edit()">Edit Table</button>
        <div class="table-responsive p-2 bg-white">
          <table class="table table-striped">
            <thead>
              <th class="hide">Manage</th>
              <th>Worker ID</th>
              <th>Name</th>
              <th>Contact</th>
              <th>Department</th>
              <th>Experience</th>
              
            </thead>
            <tbody>
              <form action="allEmployees.php" method="post">
            ';
            while($row = mysqli_fetch_assoc($result)) {
                echo '<tr>
                    <td class="hide">
                      <input type="radio" name="'.$row["workerid"].'">
                    </td>
                    
                    <td>'.$row["workerid"].'</td>
                    <td>'.$row["name"].'</td>
                    <td>'.$row["contact"].'</td>
                    <td>'.$row["dept"].'</td>
                    <td>'.$row["exp"].'</td>
                </tr>';
                $sr += 1;
            }
            echo '</tbody>
            </table>
            <input type="submit" value="Delete Selected" name="submit" class="btn btn-danger hide">
            </form>
          </div>';
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/service.css">
    <link href='https://unpkg.com/boxicons@2.1.0/css/boxicons.min.css' rel='stylesheet'>

    <title>Service</title>
    <style>
      .edit {
        display: block;
      }
      .hide {
        display: none;
      }
    </style>
  </head>
  <body class="p-5">

    <?php
        printTable();
    ?>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    
      <script>
        var check = document.getElementsByClassName("hide");
        var check2 = document.getElementsByClassName("edit");
        function edit(){
          if(check.length != 0){
            Array.from(check).forEach(el => {
              el.classList.toggle("edit");
              el.classList.toggle("hide");
            });
          }else{
            Array.from(check2).forEach(el => {
              el.classList.toggle("edit");
              el.classList.toggle("hide");
            });
          }
          
        }
      </script>

  </body>
</html>