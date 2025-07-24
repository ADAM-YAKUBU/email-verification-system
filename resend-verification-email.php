<?php 
session_start();
include("./database-connection/dbconnection.php");
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resend Verification</title>
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
      <div class="card-header text-center bg-warning text-dark fw-bold">
        Resend Verification Email
      </div>
      <div class="card-body">
        <?php
          if(isset($_SESSION['status'])){
            echo '<div class="alert alert-info"><h6>' . $_SESSION['status'] . '</h6></div>';
            unset($_SESSION['status']);
          }
        ?>

        <form action="resend-code.php" method="POST">

          <div class="mb-3">
            <label for="email" class="form-label">Registered Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
          </div>

          <div class="d-grid mb-2">
            <button type="submit" name="resend_email_btn" class="btn btn-warning text-white fw-bold">
              Resend Email
            </button>
          </div>

          <div class="text-center">
            <a href="login.php" class="text-decoration-none">Back to Login</a>
          </div>

        </form>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
