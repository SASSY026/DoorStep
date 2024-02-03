<?php
include("dbconnection.php");
$error = "";
$show_modal = false;

$modalHeader = "Employee profile added successfuly!";
$modalBody = " ";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['submit'])) {
    // receive all input values from the form
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $contact = mysqli_real_escape_string($db, $_POST['contact']);
    $contact=(int)$contact;
    $dept  = mysqli_real_escape_string($db, $_POST['dept']);
    $exp = mysqli_real_escape_string($db, $_POST['exp']);
    $location = mysqli_real_escape_string($db, $_POST['location']);

    // $query = "INSERT INTO customer (Name, E-mail, Location, Contact) 
    // 	  VALUES('$name', '$Email', '$password,'$address','$contact')))";
    $query = "INSERT INTO `worker` (`workerid`, `name`, `contact`, `dept`, `exp`,`location`) VALUES (NULL, '$name', '$contact', '$dept', '$exp','$location')";

    if (mysqli_query($db, $query)) {
      $show_modal = true;
    } else {
      echo mysqli_error($db);
    }
  }
}

?>

<!doctype html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="css/master.css">
  <title>Mini Project</title>
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
            <i class='bx bx-heart'></i>
            Register as Professional
          </a>
        </div>
        <form class="d-flex">
        </form>
      </div>

    </div>
  </nav>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-6">
        <form action="regprof.php" method="post">
          <div class="mb-3 mt-3">
            <label for="name">Name: </label>
            <input type="text" name="name" placeholder="Name" class="form-control" id="name" required autocomplete="off" />
          </div>
          <div class="mb-3 mt-3">
            <label for="contact">Contact: </label>
            <input type="number" name="contact" placeholder="Contact" class="form-control" id="contact" required autocomplete="off"/>
          </div>
          <div class="mb-3">
            <label for="dept">Department: </label>
            <select class="form-select" aria-label="Default select example" name="dept" id="dept" required >
              <option selected>Open to see the list</option>
              <option value="carpentry">
                Carpentry
              </option>
              <option value="cleaning">
                Cleaning and Disinfection
              </option>
              <option value="electrician">
                Electricians
              </option>
              <option value="painting">
                Home Painting
              </option>
            </select>
          </div>
          <div class="mb-3">
            <label for="location">Location: </label>
            <select class="form-select" aria-label="Default select example" name="location" id="location" required >
              <option selected>Open to see the list</option>
              <option value="Mumbai">
                Mumbai
              </option>
              <option value="Delhi">
                Delhi
              </option>
              <option value="Pune">
                Pune
              </option>
              <option value="Chennai">
                Chennai
              </option>
              <option value="Kolkata">
                Kolkata
              </option>
              <option value="Bangalore">
                Bangalore
              </option>
            </select>
          </div>
          <div class="mb-3">
            <label for="exp">Experience: </label>
            <input type="numbers" name="exp" placeholder="Experience" class="form-control" id="exp" required autocomplete="off"/>
          </div>
          <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel"><?php echo $modalHeader; ?></h5>
                  <button type="button" class="btn btn-danger btn-sm rounded-pill" data-bs-dismiss="modal" aria-label="Close" onclick="myModal.toggle()"><i class="fa fa-times" aria-hidden="true"></i></button>
                </div>
                <div class="modal-body">
                  <?php echo $modalBody; ?>
                </div>
              </div>
            </div>
          </div>


          <input type="submit" name="submit" value="Add Profile" class="btn btn-block btn-outline-success mb-3" />
        </form>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
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