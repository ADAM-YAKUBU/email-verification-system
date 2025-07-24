<?php 
session_start();
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
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
<?php
session_start();
include("database-connection/dbconnection.php");

if (isset($_POST['loginBtn'])) {
    if (!empty(trim($_POST['email'])) && !empty(trim($_POST['password']))) {
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']); 

        $loging_query = "SELECT * FROM admins WHERE email = '$email' AND password = '$password' LIMIT 1";
        $loging_query_run = mysqli_query($con, $loging_query);

        if (mysqli_num_rows($loging_query_run) > 0) {
            $row = mysqli_fetch_array($loging_query_run);
            // echo $row['verify_status'];

            if($row['verify_status'] == '1'){
                $_SESSION['authenticated'] = TRUE;
                $_SESSION['auth_user']=[
                    'username' => $row['name'],
                    'phone' => $row['phone'],
                    'email' => $row['email']
                ];
                $_SESSION['status'] = "You have successfully login.";
                header("Location: dashboard.php");
                exit(0);

            }else{
                $_SESSION['status']="Please verify your email to login.";
                header("Location: login.php");
                exit(0);
            }
        } else {
            $_SESSION['status'] = "Invalid email or Password.";
            header("Location: login.php");
            exit(0);
        }
    } else {
        $_SESSION['status'] = "All fields required";
        header("Location: login.php");
        exit(0);
    }
}
?>
<?php 
include("authentication.php") ;?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
      <!-- Navigation Bar -->
  <nav class="bg-white shadow-md p-4 flex justify-between items-center">
    <div class="flex items-center space-x-4">
      <span class="text-xl font-bold text-blue-600">Admin Panel</span>
      <a href="#" class="text-gray-700 hover:text-blue-600">Dashboard</a>
      <a href="#" class="text-gray-700 hover:text-blue-600">Users</a>
      <a href="#" class="text-gray-700 hover:text-blue-600">Reports</a>
      <a href="#" class="text-gray-700 hover:text-blue-600">Settings</a>
    </div>
    <div class="space-x-4">
      <span class="text-gray-600 font-medium">Welcome, Admin</span>
      <a href="logout.php" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Logout</a>
    </div>
  </nav>

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
</body>
</html>
<?php
session_start();

if(!isset($_SESSION['authenticated'])){
    $_SESSION['status'] = "Please login to access user dashboard.";
    header("Location: login.php");
    exit(0);
}

?>

please  i am following a videos to do this project but i have stack here please show me to do it if user click who is not authotecated this would show "Please login to access user dashboard.";