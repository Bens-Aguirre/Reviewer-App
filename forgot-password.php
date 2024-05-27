<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="forgot-password.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>ReviewSavvy | Forgot Password</title>
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
                     <h2>Forgot Password?</h2>
                     <p>Don't worry we got you!</p>

                </div>
                <form action="send-password-reset.php" method="post">
                <div class="input-group mb-3">
                    <input type="email" class="form-control form-control-lg bg-light fs-6" placeholder="Email address" name="email" id="email">
                </div>
                <div class="input-group mb-3">
                    <button class="btn btn-lg btn-primary w-100 fs-6">Send</button>
                </div>
            </form>
          </div>
       </div> 

      </div>
    </div>
</body>
</html>