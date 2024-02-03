<?php
include("session.php");
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="css/service.css">
  <link href='https://unpkg.com/boxicons@2.1.0/css/boxicons.min.css' rel='stylesheet'>

  <title>Service</title>
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
          <?php
          if ($_SESSION['name'] != "") {
            echo "<span class='username-text'>" . $_SESSION['name'] . "</span>";
          } else {
            echo ' <a href="website.php" class="btn">Login / Register</a>';
          }
          ?>
          <span><a class="btn" href="logout.php">Log Out</a></span>
        </form>
      </div>

    </div>
  </nav>

  <?php
if(isset($_GET["page"])){
  if($_GET["page"] == "carpentry"){
    include("carpentry.php");
  }
  if($_GET["page"] == "cleaning"){
    include("cleaning.php");
  }
  if($_GET["page"] == "electricians"){
    include("elect.php");
  }
  if($_GET["page"] == "painting"){
    include("painting.php");
  }
}
?>

 

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>