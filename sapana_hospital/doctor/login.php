<?php
session_start();  // always at the top

$servername = "localhost";
$username = "root";
$password = "";
$database = "suraj";

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$notlog = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Escape inputs to prevent SQL injection
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM doctor WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if ($num == 1) {
        $doctor_row = mysqli_fetch_assoc($result);
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $doctor_row['email'];
        $_SESSION['doctor_id'] = $doctor_row['id']; 
        header("Location: docdash.php");
        exit;
    } else {
        $notlog = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - Sapana Hospital</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
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
      <a href="">Login</a>
    </div>
  </nav>

  <!-- Background -->
  <div class="background"></div>

  <!-- Animated Text -->
  <div class="animated-text">I am Doctor</div>

  <!-- Login Form -->
  <div class="form-container">
    <h2>Login</h2>
    <form method="post" action="">
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required />
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Max 8 characters" required />
      </div>
      <div class="form-group center">
        <button type="submit">Login</button>
      </div>
    </form>

    <!-- Error Message -->
    <?php if ($notlog): ?>
      <div class="alert alert-danger" role="alert">
        Invalid credentials!
      </div>
    <?php endif; ?>
  </div>

  <script src="doc.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"></script>
</body>
</html>
