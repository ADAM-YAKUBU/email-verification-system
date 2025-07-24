<?php
session_start();
include("./database-connection/dbconnection.php")
 ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Password Reset</title>
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
        Reset Password
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
        <form action="password-reset-code.php" method="POST" id="resertForm">

          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email address">
          </div>

          <div class="d-grid">
            <button type="submit" name="password_reset_link" class="btn btn-primary">
              Send Password Reset Link
            </button>
          </div>

        </form>
      </div>
    </div>
      
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      // $(document).ready(function(){

      //   $('#resertForm').on('submit' , function(e){
      //     e.preventDefault();
          
      //   })
      // })
    </script>
  </body>
</html>
