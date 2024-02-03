<?php
include("session.php");

$sql = "SELECT * FROM booking";
$result = mysqli_query($db, $sql);

$bgclass="";

function printTable()
{
  $sr = 1;
  global $result;
  if (mysqli_num_rows($result) > 0) {
    echo '
        <div class="table-responsive p-2 bg-white">
          <table class="table table-striped">
            <thead>
              <th>Booking ID</th>
              <th>Name</th>
              <th>Location</th>
              <th>Service</th>
              <th>Category</th>
              <th>Section</th>
              <th>Amount</th>
              <th>Completion Date</th>
              <th>Status</th>
            </thead>
            <tbody>
              <form action=" " method="post">
            ';
    while ($row = mysqli_fetch_assoc($result)) {
      if ($row["status"] == 'in progress'){
        $bgclass = "bg-warning";
      }
      else{
        $bgclass= "bg-success";
      }
      echo '<tr>
                    <td>' . $row["id"] . '</td>
                    <td>' . $row["name"] . '</td>
                    <td>' . $row["location"] . '</td>
                    <td>' . $row["service"] . '</td>
                    <td>' . $row["category"] . '</td>
                    <td>' . $row["section"] . '</td>
                    <td>' . $row["amount"] . '</td>
                    <td>' . $row["cmpdate"] . '</td>
                    <td><span class="badge '.$bgclass.'">' . $row["status"] . '</span></td>

                </tr>';
      $sr += 1;
    }
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="css/service.css">
  <link href='https://unpkg.com/boxicons@2.1.0/css/boxicons.min.css' rel='stylesheet'>

  <title>yb</title>
</head>

<body>

  <?php
  printTable();
  ?>

</body>

</html>