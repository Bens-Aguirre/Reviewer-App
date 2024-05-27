<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $conn = require __DIR__ . "/config.php";
    
    $sql = sprintf("SELECT * FROM users
                    WHERE email = '%s'",
                   $conn->real_escape_string($_POST["email"]));
    
    $result = $conn->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) {
        
        if (password_verify($_POST["pass"], $user["password_hash"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_id"] = $user["user_id"];
            
            header("Location: user/home.php");
            exit;
        }
    }
    
    $is_invalid = true;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="signin.css">
    <script src="js/sweetalert.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>ReviewSavvy | Sign In</title>
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
                <div class="header-text mb-4">
                     <h2>Hello, Again!</h2>
                     <p>We are happy to have you back.</p>

                    <?php if ($is_invalid): ?>
                    <script>
                        swal({
                            title: "Error!",
                            text: "Invalid Login",
                            icon: "error",
                            button: "OK",
                        });
                    </script>
                    <?php endif; ?>

                </div>
                <form action="" method="post">
                <div class="input-group mb-3">
                    <input type="email" class="form-control form-control-lg bg-light fs-6" placeholder="Email address" name="email" id="email" value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
                </div>
                <div class="input-group mb-1">
                    <input type="password" class="form-control form-control-lg bg-light fs-6" id="passwordInput" placeholder="Password" name="pass">
                    <button type="button" class="btn btn-outline-secondary bi bi-eye-slash" id="togglePassword"></button>
                </div>
                <div class="input-group mb-5 d-flex justify-content-between">
                    <div class="form-check">
                    </div>
                    <div class="forgot">
                        <small><a href="forgot-password.php">Forgot Password?</a></small>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <button class="btn btn-lg btn-primary w-100 fs-6">Login</button>
                </div>
            </form>
                <div class="row">
                    <small>Don't have account? <a href="signup.php">Sign Up</a></small>
                    <small>Admin? <a href="admin_signin.html">Login as admin</a></small>
                </div>
          </div>
       </div> 

      </div>
    </div>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const passwordInput = document.querySelector('#passwordInput');

        // Function to show/hide password
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('bi-eye');
            this.classList.toggle('bi-eye-slash');
        });
    </script>
</body>
</html>