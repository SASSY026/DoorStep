<?php
include("session.php");

$show_modal = false;
$modalHeader = "Employee profile added successfuly!";
$modalBody = " ";

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
      <a class="navbar-brand text-success" href="#"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-between" id="navbarNavAltMarkup">
        <div class="navbar-nav align-self-center">
          <a class="nav-link" href="#">
            <i class='bx bx-heart'></i>
            Register as Professional
          </a>
        </div>
        <form class="d-flex">
          <?php
          if ($_SESSION['name'] != "") {
            echo "<span class='username-text'>Welcome " . $_SESSION['name'] . "</span>";
            echo "<span ><a class='btn' href='logout.php'>Log Out</a></span>";
          } else {
            echo ' <a href="website.php" class="btn">Login / Register</a>';
          }
          ?>
        </form>
      </div>


    </div>
  </nav>


  <div class="contanier-fluid main-section mb-5">
    <div class="fullpage">
      <h1>Fast Service in your <br>neighborhood</h1>
      <h3>Book trusted Cleaners and Wokrers.</h3>
      <div class="form-holder">
        <div class="form-header">Services we offer</div>
        <div class="container py-5">
          <div class="row justify-content-center">
            <div class="col flex-center">
              <a href="services.php?page=carpentry">
                <i class='bx bx-bed text-primary'></i>
                <p>Carpenters</p>
              </a>
            </div>
            <div class="col flex-center">
              <a href="services.php?page=cleaning">
                <i class='bx bx-home-smile text-primary'></i>
              <p>Home Cleaning</p>
              </a>
            </div>
            <div class="col flex-center">
              <a href="elect.php?page=electricians">
                <i class='bx bx-bulb text-primary'></i>
                <p>Electricians</p>
              </a>
            </div>
            <div class="col flex-center">
              <a href="painting.php?page=painting">
                <i class='bx bx-brush text-primary'></i>
                <p>Home Painting</p>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <div class="chooseus">
    <h5>How It Works?</h5>
    <div class="container">
      <div class="row align-items-center justify-content-center">
      <div class="col icons">
          <i class='bx bx-user-plus text-success'></i>
          <h4>Register</h4>
          <p>Join with Us :)</p>
        </div>
        <div class="col icons">
          <i class='bx bxs-hand-up text-secondary'></i>
          <h4>Select Service</h4>
          <p>Carpentry, Electrician, Home painting...</p>
        </div>
        <div class="col icons">
          <i class='bx bx-credit-card text-info'></i>
          <h4>Payment</h4>
          <p>Use your Card or Paypal</p>
        </div>
        <div class="col icons">
          <i class='bx bx-happy-alt text-warning'></i>
          <h4>Time to Relax</h4>
          <p>We will be at your service!</p>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>