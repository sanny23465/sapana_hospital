<?php
include 'connect.php';

$login = false;
$notlog = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = $_POST['email'];
  $id = $_POST['id'];  
  $password = $_POST['password'];

  $sql = "SELECT * FROM patient WHERE email='$email' AND id='$id' AND password='$password'";
  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);

  if ($num == 1) {
    $patient_row = mysqli_fetch_assoc($result);
    $login = true;

    session_start();
    $_SESSION['loggedin'] = true;
    $_SESSION['email'] = $patient_row['email'];
    $_SESSION['patient_id'] = $patient_row['id'];

    header("location:dash.php");
    exit;
  } else {
    $notlog = true;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- (head content unchanged, same as before) -->
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login - Sapana Hospital</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="index.css" />
  <style>
    .form-container {
      position: absolute;
      top: 60%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: rgba(255, 255, 255, 0.95);
      padding: 20px 25px; /* Reduced padding */
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: 90%;
      max-width: 400px;
    }

  </style>
</head>
<body>
  <!-- Navbar (same as before) -->
  <nav class="navbar">
    <div class="logo">
      <img src="index.png" alt="Logo" />
      <span>Sapana Hospital</span>
    </div>
    <div class="nav-links">
      <a href="/sapana_hospital">Signup</a>
      <a href="/sapana_hospital/login.php">Login</a>
    </div>
  </nav>

  <div class="background"></div>
  <div class="animated-text">I am patient</div>

  <div class="form-container">
    <h2>Login</h2>
    <form method="post" action="/sapana_hospital/login.php">
      <div class="form-group mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" class="form-control" required />
      </div>
      <div class="form-group mb-3">
        <label for="id" class="form-label">Id</label>
        <input type="text" id="id" name="id" placeholder="Enter your unique ID" class="form-control" required />
      </div>
      <div class="form-group mb-4">
        <label for="password" class="form-label">Password</label>
        <input type="password" id="password" name="password" placeholder="Max 8 characters" class="form-control" maxlength="8" required />
      </div>
      <div class="form-group text-center">
        <button type="submit" class="btn btn-primary px-5">Login</button>
      </div>
    </form>

    <?php if ($login): ?>
      <div class="alert alert-success mt-3" role="alert">
        You have logged in successfully.
      </div>
    <?php endif; ?>

    <?php if ($notlog): ?>
      <div class="alert alert-danger mt-3" role="alert">
        Invalid email, ID, or password!
      </div>
    <?php endif; ?>
  </div>

  <script src="index.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"></script>
</body>
</html>
