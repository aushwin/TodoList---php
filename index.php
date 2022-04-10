<?php

include "includes/config.php";
session_start();
if(isset($_SESSION["user_email"])){
    header("Location: todos.php");
    die();
}



?>
<!doctype html>
<html lang="en">
  <head>
   <?php getHead(); ?>
   <style> 
  body,html {
  height: 100%;
}
  </style>
  </head>
  <body>
    <div class="container col-xl-10 col-xxl-8 px-4 py-5 justify-content-center h-100">
        <div class="row align-items-center g-lg-5 py-5">
          <div class="col-lg-7 text-center text-lg-start">
            <h1 class="display-4 fw-bold lh-1 mb-3">To Store , Kindly Sign Up</h1>
            <p class="col-lg-10 fs-4">No more forgetting tasks. Store them in your second brain safely ! </p>
          </div>
          <div class="col-md-10 mx-auto col-lg-5">
            <form action="login.php" method="POST" class="p-4 p-md-5 border rounded-3 bg-light">
              <div class="form-floating mb-3">
                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
              </div>
              <div class="form-floating mb-3">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
              </div>
             
              <button name="submit" class="w-100 btn btn-lg btn-primary" type="submit">Continue</button>
              <hr class="my-4">
              <small class="text-muted">By clicking Sign up, you agree to the terms of use.</small>
            </form>
          </div>
        </div>
      </div>

  </body>
</html>
