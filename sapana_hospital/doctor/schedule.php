<?php
session_start();

// DB config
$servername = "localhost";
$username = "root";
$password = "";
$database = "suraj";

// Connect to DB
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Check login
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  header("Location: login.php");
  exit;
}

$doctor_id = $_SESSION['doctor_id'];
$updated = false;
$row = null;

// Handle time update
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['update_time'])) {
  $time = mysqli_real_escape_string($conn, $_POST['time']);
  $sql = "UPDATE doctor SET time='$time' WHERE id='$doctor_id'";
  if (mysqli_query($conn, $sql)) {
    $updated = true;
  }
}

// Fetch doctor's data
$sql = "SELECT * FROM doctor WHERE id='$doctor_id'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) === 1) {
  $row = mysqli_fetch_assoc($result);
} else {
  die("Doctor not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Doctor Schedule - Sapana Hospital</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <style>
    * { box-sizing: border-box; }
    body {
      background: #f0faff;
      padding: 90px 20px 20px;
      margin: 0;
      font-family: Arial, sans-serif;
      color: #333;
    }

    .navbar {
      background: #00b8b8;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 50px;
      display: flex;
      align-items: center;
      padding: 0 20px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      z-index: 1050;
    }

    .navbar .logo {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .navbar .logo img {
      height: 40px;
      width: 40px;
      object-fit: contain;
    }

    .navbar .logo span {
      color: white;
      font-size: 1.25rem;
      font-weight: bold;
      user-select: none;
    }

    .back-link {
      display: inline-block;
      margin: 5px 0 20px 20px;
      color: #00b8b8;
      font-weight: 600;
      font-size: 1rem;
      text-decoration: none;
      transition: color 0.3s ease;
      user-select: none;
    }

    .back-link:hover {
      color: #008080;
      text-decoration: underline;
    }

    .container {
      max-width: 600px;
      margin: 0 auto 40px;
      padding: 0 15px;
    }

    label {
      display: block;
      font-weight: 600;
      margin-bottom: 6px;
    }

    input[type="text"] {
      width: 100%;
      padding: 8px 10px;
      border: 1.5px solid #ccc;
      border-radius: 6px;
      font-size: 1rem;
      transition: border-color 0.3s;
    }

    input[type="text"]:focus {
      border-color: #00b8b8;
      outline: none;
    }

    button {
      width: 100%;
      background-color: #0d6efd;
      border: none;
      color: white;
      padding: 10px;
      font-size: 1rem;
      font-weight: 600;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #084bcc;
    }

    .card {
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      border-radius: 12px;
      padding: 15px;
      background: white;
    }

    .card-header {
      background-color: #00b8b8;
      color: white;
      font-weight: bold;
      padding: 8px 15px;
      border-radius: 12px 12px 0 0;
      text-align: center;
      font-size: 1.1rem;
    }

    p {
      margin: 8px 0;
      font-size: 1rem;
    }

    .alert {
      padding: 12px 15px;
      border-radius: 6px;
      font-weight: 600;
      margin-bottom: 20px;
      text-align: center;
    }

    .alert-success {
      background-color: #d1e7dd;
      color: #0f5132;
      border: 1px solid #badbcc;
    }
  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar">
    <div class="logo">
      <img src="index.png" alt="Logo" />
      <span>Sapana Hospital</span>
    </div>
  </nav>

  <!-- Back Link -->
  <a href="docdash.php" class="back-link">← Back to Dashboard</a>

  <div class="container">
    <!-- Success Message -->
    <?php if ($updated): ?>
      <div class="alert alert-success">Time updated successfully!</div>
    <?php endif; ?>

    <!-- Doctor Card -->
    <div class="card">
      <div class="card-header">Doctor ID: <?= htmlspecialchars($row['id']) ?></div>
      <div class="card-body">
        <p><strong>Name:</strong> <?= htmlspecialchars($row['Name']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($row['email']) ?></p>
        <p><strong>Phone:</strong> <?= htmlspecialchars($row['phone']) ?></p>
        <p><strong>Specialist:</strong> <?= htmlspecialchars($row['specialist']) ?></p>
        <form method="post" action="schedule.php">
          <div class="mb-3">
            <label for="time"><strong>Time:</strong></label>
            <input type="text" id="time" name="time" value="<?= htmlspecialchars($row['time']) ?>" required />
          </div>
          <button type="submit" name="update_time" style="background-color:#28a745; margin-top: 5px;">Update Time</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
