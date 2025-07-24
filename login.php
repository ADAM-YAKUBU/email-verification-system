<?php 
session_start();

if(isset($_SESSION['authenticated'])){
    $_SESSION['status'] = "Your have already login.";
    header("Location: dashboard.php");
    exit(0);
}

include("./database-connection/dbconnection.php");
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      body {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa;
      }
      .card {
        width: 100%;
        max-width: 400px;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        border: none;
        border-radius: 1rem;
      }
    </style>
  </head>
  <body>
  <a href="dashboard.php">Dashboard</a>
    <div class="card">
      <div class="card-header text-center bg-primary text-white fw-bold">
        Login
      </div>
      <div class="card-body">
      <?php
        if(isset($_SESSION['status'])){
          ?>
          <div class="alert alert-success">
            <h5><?php echo $_SESSION['status']?></h5>
          </div>
          <?php
        }
        unset($_SESSION['status']);
        ?>
        <form action="logincode.php" method="POST">

          <div class="mb-3">
            <label for="username" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter entermail" >
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" >
          </div>

          <div class="d-grid mb-2">
            <button type="submit" name="loginBtn" class="btn btn-primary">
              Login
            </button>
          </div>

          <div class="text-center">
            <a href="password-reset.php" class="text-decoration-none">Forgot password?</a>
          </div>

        </form>

        <hr>
        <h5>
          Did not receive your verification email
          <a href="resend-verification-email.php">Resend</a>
        </h5>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
