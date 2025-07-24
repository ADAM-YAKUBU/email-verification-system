<?php 
session_start();
include("./database-connection/dbconnection.php") 
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
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

    <div class="card">
      <div class="card-header text-center bg-primary text-white fw-bold">
        Register
      </div>
      <div class="card-body">
        <div class="alert">
          <?php
            if(isset($_SESSION['status'])){
              echo "<h4>".$_SESSION['status']."</h4>";
              unset($_SESSION['status']);
            }
          ?>
        </div>
        <form action="code.php" method="POST">

          <div class="mb-3">
            <label for="fullname" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter your full name" required>
          </div>

          <div class="mb-3">
            <label for="username" class="form-label">Phone Number</label>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone number" required>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter a password" required>
          </div>

          <div class="mb-3">
            <label for="cpassword" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm your password" required>
          </div>

          <div class="d-grid mb-2">
            <button type="submit" name="register" class="btn btn-primary">
              Register
            </button>
          </div>

          <div class="text-center">
            <small>Already have an account? <a href="login.php" class="text-decoration-none">Login</a></small>
          </div>

        </form>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
