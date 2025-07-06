<?php
$servername="localhost";
$username="root";
$password="";
$database="suraj";
//connection 
$conn=mysqli_connect($servername, $username, $password, $database);

session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
  header("location:adminlogin.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin dash - Sapana Hospital</title>
  <link rel="stylesheet" href="admin.css" />
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar">
    <div class="logo">
      <img src="index.png" alt="Logo" />
      <span>Sapana Hospital</span>
    </div>
    
    <div class="nav-links">
      <a href="#" onclick="confirmLogout()">Logout</a>
    </div>
  </nav>
  <dic class="container">
    <!-- Sidebar -->
  <div class="sidebar">
    <div class="logo-section">
      <a href="admindetail.php"><img src="user.png" alt="Logo" /></a>
      <!-- <h2>Sapana Hospital</h2> -->
    </div>

    <a href="/sapana_hospital/admin/admindash.php">Home</a>

    <!-- Category with Dropdown -->
    <div class="dropdown">
      <button class="dropdown-btn">Category ▾</button>
      <div class="dropdown-content">
        <a href="cardio.php">Cardiologist</a>
        <a href="neuro.php">Neurologist</a>
        <a href="ortho.php">orthopedic</a>
        <!-- <a href="#"></a> -->
        <!-- <a href="#"></a> -->
      </div>
    </div>

    <a href="docdetail.php">All Doctor</a>
    <a href='patdetail.php'>Patients</a>
    <a href="admindetail.php">Setting</a>
  </div>

  <!-- Main Content -->
  <div class="main-content" >
    <div class="animated-text">I am Admin</div><br><br><br><br>
    <h1 >Welcome to Sapana Hospital,<br>
  We take care of your health.<br>
Book and appointment oline,</h1><br>
<p>We make you easy. <br>
Fast, secure and reliable.</p>
    <p>This is the dashboard. Choose options from the sidebar.</p>
    
  </div>
  <script src="admin.js"></script>
  <script>
    // Toggle the dropdown
    document.querySelector('.dropdown-btn').addEventListener('click', function () {
      this.classList.toggle('active');
      const dropdownContent = this.nextElementSibling;
      dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
    });
  </script>
</body>
</html>