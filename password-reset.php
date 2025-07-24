<?php
session_start();
include("./database-connection/dbconnection.php");
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Password Reset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      html, body {
        margin: 0;
        padding: 0;
        height: 100%;
        background-color: #f8f9fa;
      }

      body {
        display: flex;
        flex-direction: column;
      }

      .main-content {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
      }

      .card {
        width: 100%;
        max-width: 400px;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        border: none;
        border-radius: 1rem;
        background: #fff;
      }
    </style>
  </head>
  <body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <div class="container">
        <a class="navbar-brand fw-bold" href="login.php">Login page</a>
        <a class="navbar-brand fw-bold" href="register.php">Register page</a>
      </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
      <div class="card">
        <div class="card-header text-center bg-primary text-white fw-bold">
          Reset Password
        </div>
        <div class="card-body">
          <?php
          if(isset($_SESSION['status'])){
            echo '<div class="alert alert-success"><h5>' . $_SESSION['status'] . '</h5></div>';
            unset($_SESSION['status']);
          }
          ?>
          <form action="password-reset-code.php" method="POST" id="resetForm">

            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Email address</label>
              <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email address" required>
            </div>

            <div class="d-grid">
              <button type="submit" name="password_reset_link" class="btn btn-primary">
                Send Password Reset Link
              </button>
            </div>

          </form>
        </div>
      </div>
    </div>
      
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      // Optional: Future AJAX form submission
    </script>
  </body>
</html>
