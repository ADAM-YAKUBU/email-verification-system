<?php include("dashboard.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">
    
  <div class="p-6">
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
    <h1 class="text-3xl font-bold mb-4">🌟 Ultimate Admin Dashboard</h1>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
      <div class="bg-white p-4 rounded-xl shadow-xl">
        <h2 class="text-lg font-semibold">Total Users</h2>
        <p class="text-2xl font-bold text-blue-600">1203</p>
      </div>
      <div class="bg-white p-4 rounded-xl shadow-xl">
        <h2 class="text-lg font-semibold">Verified Users</h2>
        <p class="text-2xl font-bold text-green-600">1147</p>
      </div>
      <div class="bg-white p-4 rounded-xl shadow-xl">
        <h2 class="text-lg font-semibold">Pending Verifications</h2>
        <p class="text-2xl font-bold text-yellow-500">56</p>
      </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
      <!-- Login Activity Chart -->
      <div class="bg-white p-4 rounded-xl shadow-xl">
        <h2 class="text-lg font-semibold mb-2">Login Activity (Last 7 Days)</h2>
        <canvas id="loginChart"></canvas>
      </div>
      <!-- User Roles -->
      <div class="bg-white p-4 rounded-xl shadow-xl">
        <h2 class="text-lg font-semibold mb-2">User Role Distribution</h2>
        <canvas id="roleChart"></canvas>
      </div>
    </div>

    <!-- Activity Feed -->
    <div class="bg-white p-4 rounded-xl shadow-xl mb-6">
      <h2 class="text-lg font-semibold mb-2">Recent Activity</h2>
      <ul class="list-disc list-inside space-y-1">
        <li>Admin John logged in</li>
        <li>User Sarah registered</li>
        <li>Failed login from IP 192.168.1.10</li>
        <li>Password reset request by user Bob</li>
        <li>Admin Jane updated user roles</li>
      </ul>
    </div>

   

    <!-- Failed Login Attempts Table -->
    <div class="bg-white p-4 rounded-xl shadow-xl">
      <h2 class="text-lg font-semibold mb-2">Failed Login Attempts</h2>
      <table class="w-full text-left">
        <thead>
          <tr>
            <th class="py-2">Email</th>
            <th class="py-2">IP Address</th>
            <th class="py-2">Time</th>
          </tr>
        </thead>
        <tbody>
          <tr class="border-t">
            <td class="py-2">jake@example.com</td>
            <td class="py-2">192.168.1.101</td>
            <td class="py-2">2025-07-05 14:32</td>
          </tr>
          <tr class="border-t">
            <td class="py-2">linda@example.com</td>
            <td class="py-2">192.168.1.108</td>
            <td class="py-2">2025-07-05 13:47</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Chart Script -->
  <script>
    const loginChart = new Chart(document.getElementById('loginChart'), {
      type: 'line',
      data: {
        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        datasets: [{
          label: 'Logins',
          data: [112, 98, 123, 150, 170, 200, 189],
          fill: true,
          borderColor: 'rgb(59, 130, 246)',
          backgroundColor: 'rgba(59, 130, 246, 0.2)',
          tension: 0.3
        }]
      },
    });

    const roleChart = new Chart(document.getElementById('roleChart'), {
      type: 'doughnut',
      data: {
        labels: ['Admins', 'Editors', 'Viewers'],
        datasets: [{
          data: [12, 34, 86],
          backgroundColor: ['#10B981', '#F59E0B', '#3B82F6']
        }]
      },
    });
  </script>
</body>
</html>
