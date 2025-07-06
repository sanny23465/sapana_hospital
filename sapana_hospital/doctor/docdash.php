<?php 
$servername="localhost";
$username="root";
$password="";
$database="suraj";
//connection 
$conn=mysqli_connect($servername, $username, $password, $database);

session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
  header("location:doclogin.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Doc_dash - Sapana Hospital</title>
  <link rel="stylesheet" href="doc.css" />
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar">
    <div class="logo">
      <img src="index.png" alt="Logo" />
      <span>Sapana Hospital</span>
    </div>
    
    <div class="nav-links">
      <a href="login.php" onclick="confirmLogout()">Logout</a>
    </div>
  </nav>
  <dic class="container">
    <!-- Sidebar -->
  <div class="sidebar">
    <div class="logo-section">
      <a href="setting.php"><img src="user.png" alt="Logo" /></a>
      <!-- <h2>Sapana Hospital</h2> -->
    </div>

    <a href="/sapana_hospital/doctor/docdash.php">Home</a>


    <a href="mybook.php">My appointment</a>
    <a href="schedule.php">Schedule</a>
    <!-- <a href="#">My appointment</a> -->
    <a href="setting.php">Setting</a>
  </div>

  <!-- Main Content -->
  <div class="main-content" >
    <div class="animated-text">I am doctor</div><br><br><br><br>
    <h1 >Welcome to Sapana Hospital,<br>
  We take care of your health.<br>
Book and appointment oline,</h1><br>
<p>We make you easy. <br>
Fast, secure and reliable.</p>
    <p>This is the dashboard. Choose options from the sidebar.</p>
    
  </div>
  <script src="doc.js"></script>
</body>
</html>