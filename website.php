<?php
include("dbconnection.php");
session_start();
$error = "";
$show_modal = false;

$modalHeader = "OOPS!";
$modalBody = "Name orE-mail Id already exists.. ";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["login_submit"])) {
        $myusername = mysqli_real_escape_string($db, $_POST['Username']);
        $mypassword = mysqli_real_escape_string($db, $_POST['Password']);
        $mypassword = md5($mypassword);
        
        
        $sql = "SELECT Id FROM login WHERE Username = '$myusername' and Password = '$mypassword'";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        
        $count = mysqli_num_rows($result);
        $location_sql = mysqli_query($db,"SELECT location FROM `customer` WHERE `name` LIKE '$myusername'");
        $loc_row = mysqli_fetch_assoc($location_sql);
        $_SESSION['location'] = $loc_row['location'];
        
        if(isset($_POST["rembPass"])){
            $rembPass = $_POST["rembPass"];
            foreach($rembPass as $val){
                setcookie("user",$_SESSION['name'], time() + (86400 * 30), "/");
            }
        }
        if(isset($_COOKIE["user"])){
            $_SESSION['name'] = $_COOKIE["user"];
            header('location: index.php');
        }

        if ($count == 1) {
            $_SESSION['name'] = $myusername;
            $_SESSION['location'] = $loc;
            header("location: index.php");
        } else {
            $error = "Your Login Name or Password is invalid";
        }
    }
}

$errors = array();

// REGISTER USER
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['reg_user'])) {
        // receive all input values from the form
        $name = mysqli_real_escape_string($db, $_POST['Name']);
        $email  = mysqli_real_escape_string($db, $_POST['E-mail']);
        $location = mysqli_real_escape_string($db, $_POST['Location']);
        $password = mysqli_real_escape_string($db, $_POST['Password']);
        $contact = mysqli_real_escape_string($db, $_POST['Contact']);

        // first check the database to make sure 
        // a user does not already exist with the same username and/or email
        $user_check_query = "SELECT * FROM `customer` WHERE name='$name' OR email='$email' LIMIT 1";
        $result = mysqli_query($db, $user_check_query);
        $user = mysqli_fetch_assoc($result);

        if ($user) { // if user exists
            if ($user['name'] === $name) {
                array_push($errors, "name already exists");
            }

            if ($user['email'] === $email) {
                array_push($errors, "email already exists");
            }
        }

        // Finally, register user if there are no errors in the form
        if (count($errors) == 0) {
            $password = md5($password); //encrypt the password before saving in the database

            // $query = "INSERT INTO customer (Name, E-mail, Location, Contact) 
            // 	  VALUES('$name', '$Email', '$password,'$address','$contact')))";
            $query = "INSERT INTO `customer` (`sr`, `name`, `email`, `contact`, `location`) VALUES (NULL, '$name', '$email', '$contact', '$location')";
            $query2 = "INSERT INTO `login` (`Id`, `Username`, `Password`) VALUES (NULL, '$name', '$password')";
            if (mysqli_query($db, $query)) {
                echo "success query 1";
            } else {
                $show_modal = true;
                echo mysqli_error($db);
            }
            if (mysqli_query($db, $query2)) {
                echo "success query 2";
            } else {
                echo mysqli_error($db);
            }

            $_SESSION['name'] = $name;
            $_SESSION['location'] = $location;
            header('location: index.php');
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <title>DoorStep</title>
    <link rel="stylesheet" href="css/web.css">
</head>

<body>
    <div class="full-page" style=>
        <nav class="navbar navbar-expand-lg navbar-light bg-light nav">
            <div class="container-fluid px-5">
                <a class="navbar-brand text-success" href="index.php">Logo</a>
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
                </div>

            </div>
        </nav>
        <div id='signup-form' class='signup-page'>
            <div class="form-box">
                <div class='button-box'>
                    <div id='btn'></div>
                    <button type='button' onclick='signup()' class='toggle-btn group-btn active'>Login</button>
                    <button type='button' onclick='register()' class='toggle-btn group-btn'>Register</button>
                </div>
                <div class="wrap" id="wrap">
                    <form id='signup' class='input-group-signup' method=post action="website.php">
                        <input type='text' class='input-field' placeholder='Username' name="Username" required autocomplete="off">
                        <input type='password' class='input-field' placeholder='Enter Password' name="Password" required autocomplete="off">
                        <input type='checkbox' class='check-box' name="rembPass" value="true"><span>Remember Password</span>
                        <button type='submit' class='submit-btn' name="login_submit">Login</button>
                        <p>
                            <?php
                            echo $error;
                            ?>
                        </p>
                    </form>
                    <form id='register' class='input-group-register' method=post action="website.php">
                        <input type='text' class='input-field' placeholder='Name' name="Name" required autocomplete="off">
                        <select name="Location" required class="input-field">
                            <option selected disabled>Select City</option>
                            <option value="Mumbai">Mumbai</option>
                            <option value="Pune">Pune</option>
                            <option value="Bangalore">Bangalore</option>
                            <option value="Chennai">Chennai</option>
                            <option value="Delhi">Delhi</option>
                            <option value="Kolkata">Kolkata</option>
                        </select>
                        <input type='email' class='input-field' placeholder='Email Id' name="E-mail" required autocomplete="none">
                        <input type='Phone Number' class='input-field' placeholder='Contact' name="Contact" required autocomplete="none">
                        <input type='Password' class='input-field' placeholder='Password' name="Password" required>
                        <button type='submit' class='submit-btn my-4' name="reg_user">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        var x = document.getElementById('wrap');
        var z = document.getElementById('btn');
        var toggleBtns = document.getElementsByClassName("toggle-btn");

        function register() {
            x.style.marginLeft = '-100%';
            z.style.marginLeft = '110px';
            toggleBtns[1].classList.add("active");
            toggleBtns[0].classList.remove("active");
        }

        function signup() {
            x.style.marginLeft = '0px';
            z.style.marginLeft = '0px';
            toggleBtns[0].classList.add("active");
            toggleBtns[1].classList.remove("active");
        }
    </script>
</body>

</html>