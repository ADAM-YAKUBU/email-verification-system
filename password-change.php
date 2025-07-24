<?php
session_start(); 
include("./database-connection/dbconnection.php") ;
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Change Password</title>
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
        Change Password
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
        <form action="password-reset-code.php" method="POST">

            <input type="hidden" name="password_token" value="<?php if(isset($_GET['token'])){echo $_GET['token'] ;}?>" >
          <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" value="<?php if(isset($_GET['email'])){echo $_GET['email'];}?>" id="email" name="email" placeholder="Enter your email" required>
          </div>

          <div class="mb-3">
            <label for="new_password" class="form-label">New Password</label>
            <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter a new password" required>
          </div>

          <div class="mb-3">
            <label for="confirm_password" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm your new password" required>
          </div>

          <div class="d-grid mb-2">
            <button type="submit" name="update_password" class="btn btn-primary">
              Update Password
            </button>
          </div>

        </form>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
