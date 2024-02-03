<?php
  include("session.php");
  $dept = $_GET["service"];
  $category = $_GET["category"];
  $amount = 0;
  $arr = $_GET['section'];
  $arr = explode(",",$arr);
  
  
  if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["bookSlot"])){
      $name=$_SESSION['name'];
      $loc=$_SESSION['location'];
      echo $loc;
      $section = $_POST['section'];
      $filterquery = "SELECT * FROM worker WHERE `dept` LIKE '$dept' AND `location` LIKE '$loc' ORDER BY `freedate` ASC" ;
      $result= mysqli_query($db,$filterquery);
      if(mysqli_num_rows($result) > 0){
          $row = mysqli_fetch_assoc($result);
          global $availdate;
          // while($row = mysqli_fetch_assoc($result)){
          //   foreach ($row as $key => $value){
          //     echo $value."<br>";
          //   }
          //}
          $availdate = $row["freedate"];
      }
 
        
      $amount= getPrice($section);
      $jobreq = getReqDate($section);
      echo $availdate."<br>".$jobreq;
      $finaldate = date('d-m-Y', strtotime($availdate. ' + '.$jobreq.' days'));

      echo $finaldate;
      $sql = "INSERT INTO `booking` (id, name, location, service, category, section, amount, cmpdate, status) VALUES (NULL, '$name','$loc','$dept','$category','$section','$amount','$finaldate','in progress')";
      if (mysqli_query($db, $sql)){
        $currworker = $row['workerid'];
        $availdate_sql = " UPDATE `worker` SET `freedate` = '$finaldate' WHERE `worker`.`workerid` = $currworker ";
        mysqli_query($db,$availdate_sql);
        header("location: index.php");
      }else{
          echo mysqli_error($db);
      }
    }
  }
  function getPrice($section){
    switch ($section){
      case 'Bed repair': $amount = 5000;
      break;
      case 'Cupboard repair': $amount = 6000;
      break;
      case 'Table repair': $amount = 3000;
      break;
      case 'Bed': $amount = 3000;
      break;
      case 'Cupboard': $amount = 3000;
      break;
      case 'Table': $amount = 3000;
      break;
      case 'Doors': $amount = 3000;
      break;
      case 'Shelves': $amount = 2000;
      break;
      case 'Windows': $amount = 3000;
      break;
      case 'Center table': $amount = 3000;
      break;
      case 'TV unit': $amount = 3000;
      break;
      case 'Wall textures': $amount = 1000;
      break;
      case 'Furnitures': $amount = 1000;
      break;
      case 'Bedroom': $amount = 1000;
      break;
      case 'Living room': $amount = 1000;
      break;
      case 'Kitchen': $amount = 1000;
      break;
      case 'Full Home Package': $amount = 1000;
      break;
      case 'Switch and Sockets': $amount = 1000;
      break;
      case 'Wiring': $amount = 1000;
      break;
      case 'MCB and Fuse': $amount = 1000;
      break;
      case 'Air Conditioner': $amount = 1000;
      break;
      case 'Refrigerator': $amount = 1000;
      break;
      case 'Television': $amount = 1000;
      break;
      case 'Washing Machine': $amount = 1000;
      break;
      case 'Just Book an Electrician': $amount = 1000;
      break;
    }
    return $amount;
  }
  function getReqDate($section){
    switch ($section){
      case 'Bed repair': $jobreq = "3";
      break;
      case 'Cupboard repair': $jobreq = "2";
      break;
      case 'Table repair': $jobreq = "2";
      break;
      case 'Bed': $jobreq = "3";
      break;
      case 'Cupboard': $jobreq = "3";
      break;
      case 'Table': $jobreq = "3";
      break;
      case 'Doors': $jobreq = "3";
      break;
      case 'Shelves': $jobreq = "3";
      break;
      case 'Windows': $jobreq = "3";
      break;
      case 'Center table': $jobreq = "3";
      break;
      case 'TV unit': $jobreq = "3";
      break;
      case 'Wall textures': $jobreq = "3";
      break;
      case 'Furnitures': $jobreq = "3";
      break;
      case 'Bedroom': $jobreq = "3";
      break;
      case 'Living room': $jobreq = "3";
      break;
      case 'Kitchen': $jobreq = "3";
      break;
      case 'Full Home Package': $jobreq = "3";
      break;
      case 'Switch and Sockets': $jobreq = "3";
      break;
      case 'Wiring': $jobreq = "3";
      break;
      case 'MCB and Fuse': $jobreq = "3";
      break;
      case 'Air Conditioner': $jobreq = "3";
      break;
      case 'Refrigerator': $jobreq = "3";
      break;
      case 'Television': $jobreq = "3";
      break;
      case 'Washing Machine': $jobreq = "3";
      break;
      case 'Just Book an Electrician': $jobreq = "3";
      break;
    }
    return $jobreq;
  }


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="css/booking.css" />
    <title>Booking</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light nav">
      <div class="container-fluid px-5">
        <a class="navbar-brand text-success" href="#">Logo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarNavAltMarkup">
          <div class="navbar-nav align-self-center">
            <a class="nav-link" href="regprof.php">
              <i class="bx bx-heart"></i>
              Register as Professional
            </a>
          </div>
          <form class="d-flex">
          <?php
              if ($_SESSION['name'] != "" ){
                echo "<span>".$_SESSION['name']."</span>";
            }
            else{
              echo ' <a href="website.php" class="btn">Login / Register</a>';
            }
            ?>
            <span><a class="btn" href="logout.php">Log Out</a></span>
          </form>
        </div>
      </div>
    </nav>

    <div class="container-fluid main">
      <div class="bg-holder">
        <div class="row">
          <h1 class="p-5">Booking Confirmation</h1>
        </div>
        <div class="container">
            <div class="selected-service">
              <form action="booking.php?service=<?php echo $dept;?>&category=<?php echo $category;?>" method="post">
                <table class="table table-striped table-borderless">
                  <tbody>
                    <tr>
                      <th scope="row">Name</th>
                      <td><?php echo $_SESSION['name'];?></td>
                    </tr>
                    <tr>
                      <th scope="row">Location</th>
                      <td><?php echo $_SESSION['location'];?></td>
                    </tr>
                    <tr>
                      <th scope="row">Service</th>
                      <td><?php echo $dept;?></td>
                    </tr>
                    <tr>
                      <th scope="row">Category</th>
                      <td><?php echo $category;?></td>
                    </tr>
                    <tr>
                      <th scope="row">Select Section</th>
                      <td>
                      <select class="form-select" aria-label="Default select example" name="section">
                        <option disabled selected>Open to see the list</option>
                        <?php
                        foreach($arr as $section){
                          echo'<option value="'.$section.'">
                          '.$section.'
                        </option>';
                        }
                        ?>
                      </select>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">Amount: <?php echo $amount;?></th>
                      <td class="flex-push">
                          <button class="btn btn-default text-danger">Cancel</button>
                          <button class="btn btn-success" type="submit" name="bookSlot">Book</button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </form>
            </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
    $("#profileDropdown").click(function() {
      $("#profileDropdownMenu").toggle("display");
    });
  </script>
  <script>
    var myModal = new bootstrap.Modal(document.getElementById('successModal'), {
      keyboard: false
    });
  </script>
  <?php if ($show_modal == true) {
    echo "<script> myModal.toggle();</script>";
  } ?>
  </body>
</html>
