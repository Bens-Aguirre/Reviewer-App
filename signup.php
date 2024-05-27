<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="signup.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="js/sweetalert.js"></script>
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
    <script src="js/validation.js" defer></script>
    <title>ReviewSavvy | Sign Up</title>
</head>
<body>
    
    

    <!----------------------- Main Container -------------------------->

     <div class="container d-flex justify-content-center align-items-center min-vh-100">

    <!----------------------- Login Container -------------------------->

       <div class="row border rounded-5 p-3 bg-white shadow box-area">

    <!--------------------------- Left Box ----------------------------->

       <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #47b5ff;">
           <div class="featured-image mb-3">
            <img src="images/Review_App_Logo-withname-removebg.png" class="img-fluid" style="width: 250px;">
           </div>
           <small class="text-black text-wrap text-center" style="width: 17rem;font-family: 'Courier New', Courier, monospace;">The app that you need for reviewing.</small>
       </div> 

    <!-------------------- ------ Right Box ---------------------------->
        
       <div class="col-md-6 right-box">
          <div class="row align-items-center">
                <div class="header-text mb-3">
                     <h2>Hello, Sign Up Now!</h2>
                     <p>It's free and easy to do.</p>
                </div>
                <form action="" method="post" id="signup" novalidate>
                <div class="input-group mb-4">
                    <input type="text" class="form-control form-control-lg bg-light fs-6" placeholder="Name" id="name" name="name">
                </div>
                <div class="input-group mb-4">
                    <input type="email" class="form-control form-control-lg bg-light fs-6" placeholder="Email address" id="email" name="email">
                </div>
                <div class="input-group mb-4">
                    <input type="password" class="form-control form-control-lg bg-light fs-6" id="pass" placeholder="Password" name="pass">
                </div>
                <div class="input-group mb-4">
                    <input type="password" class="form-control form-control-lg bg-light fs-6" id="pass_confirmation" placeholder="Repeat Password" name="pass_confirmation">
                </div>
                <div class="input-group mb-3">
                    <button class="btn btn-lg btn-primary w-100 fs-6">Create Account</button>
                </div>
            </form>
                <div class="row">
                    <small>Already have account? <a href="signin.php">Sign In</a></small>
                </div>
          </div>
       </div> 

      </div>
    </div>
</body>
</html>

<?php
if (empty($_POST["name"])) {
    die("Name is required");
}

if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required");
}

if (strlen($_POST["pass"]) < 8) {
    die("Password must be at least 8 characters");
}

if ( ! preg_match("/[a-z]/i", $_POST["pass"])) {
    die("Password must contain at least one letter");
}

if ( ! preg_match("/[0-9]/", $_POST["pass"])) {
    die("Password must contain at least one number");
}

if ($_POST["pass"] !== $_POST["pass_confirmation"]) {
    die("Passwords must match");
}

$password_hash = password_hash($_POST["pass"], PASSWORD_DEFAULT);

$conn = require __DIR__ . "/config.php";

$sql = "INSERT INTO users (name, email, password_hash)
        VALUES (?, ?, ?)";
        
$stmt = $conn->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $conn->error);
}

$stmt->bind_param("sss",
                  $_POST["name"],
                  $_POST["email"],
                  $password_hash);
                  
if ($stmt->execute()) {
    ?>

        <script>
                swal({
                    title: "Nice!",
                    text: "Account Created Successfully",
                    icon: "success",
                    button: "OK",
                });
              </script>
        <?php
} else {
    
    if ($conn->errno === 1062) {
        ?>

        <script>
                swal({
                    title: "Error!",
                    text: "Email already taken",
                    icon: "error",
                    button: "OK",
                });
              </script>
        <?php
    } else {
        ?>

        <script>
                swal({
                    title: "Error!",
                    text: "An error occurred. Please try again later.",
                    icon: "error",
                    button: "OK",
                });
              </script>
              <?php
    }
}
?>
