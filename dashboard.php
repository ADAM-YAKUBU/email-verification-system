<?php
session_start();
include("authentication.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Dashboard</title>
  <meta charset="UTF-8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    body {
      padding: 20px;
    }
  </style>
</head>
<body>

<!-- Navbar with Profile Dropdown -->
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="#">Dashboard</a>
    <div class="dropdown ms-auto">

      <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <?php echo $_SESSION['auth_user']['username']; ?>
      </button>

      <ul class="dropdown-menu dropdown-menu-end">
        <li class="dropdown-header">Profile</li>
        <li><span class="dropdown-item-text"><strong>Username:</strong> <?php echo $_SESSION['auth_user']['username']; ?></span></li>
        <li><span class="dropdown-item-text"><strong>Phone:</strong> <?php echo $_SESSION['auth_user']['phones']; ?></span></li>
        <li><span class="dropdown-item-text"><strong>Email:</strong> <?php echo $_SESSION['auth_user']['emails']; ?></span></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
      </ul>

    </div>
  </div>
</nav>

<!-- Status Message -->
<?php if (isset($_SESSION['status'])): ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <?php echo $_SESSION['status']; unset($_SESSION['status']); ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php endif; ?>

<!-- Page Content -->
<h1>Welcome to the Dashboard 🎉</h1>

<hr>
    <li class="dropdown-header">Profile</li>
    <span class="dropdown-item-text"><strong>Username:</strong> <?php echo $_SESSION['auth_user']['username']; ?></span>
    <span class="dropdown-item-text"><strong>Pone:</strong> <?php echo $_SESSION['auth_user']['phones']; ?></span>
    <span class="dropdown-item-text"><strong>Email:</strong> <?php echo $_SESSION['auth_user']['emails']; ?></span>
<hr>
</body>
</html>
