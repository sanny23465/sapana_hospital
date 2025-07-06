<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "suraj";

// Connection
$conn = mysqli_connect($servername, $username, $password, $database);

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  header("location:login.php");
  exit;
}

// Check if id parameter exists
if (!isset($_GET['id']) || empty($_GET['id'])) {
  header("location:dash.php"); // change this to your dashboard page name
  exit;
}

$id = intval($_GET['id']);

// Fetch doctor details
$sql = "SELECT * FROM doctor WHERE id = $id LIMIT 1";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
  echo "Doctor not found.";
  exit;
}

$doctor = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Doctor Details - Sapana Hospital</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>

<div class="container mt-5">
  <h1 class="mb-4">Doctor Details</h1>

  <div class="card">
    <div class="card-header">
      <h3><?= htmlspecialchars($doctor['Name']) ?></h3>
    </div>
    <div class="card-body">
      <p><strong>ID:</strong> <?= htmlspecialchars($doctor['id']) ?></p>
      <p><strong>Email:</strong> <?= htmlspecialchars($doctor['email']) ?></p>
      <p><strong>Specialist:</strong> <?= htmlspecialchars($doctor['specialist']) ?></p>
      <p><strong>Phone:</strong> <?= htmlspecialchars($doctor['phone']) ?></p>
      <p><strong>Time:</strong> <?= htmlspecialchars($doctor['time']) ?></p>
      <!-- Add more fields if you have them, e.g. date, address, etc. -->
    </div>
    <div class="card-footer">
      <a href="alldoc.php" class="btn btn-secondary">Back to List</a>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>
</html>
