<?php 
$servername = "localhost";
$username = "root";
$password = "";
$database = "suraj";

$conn = mysqli_connect($servername, $username, $password, $database);

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  header("location:doclogin.php");
  exit;
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
  echo "Invalid Request.";
  exit;
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM booking WHERE id = $id";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
  echo "Booking not found.";
  exit;
}

$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Booking</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f6f9;
      padding: 40px;
      color: #333;
    }

    .container {
      background-color: #fff;
      padding: 30px;
      border-radius: 12px;
      max-width: 600px;
      margin: auto;
      box-shadow: 0 12px 30px rgba(0,0,0,0.1);
    }

    h2 {
      color: #00b8b8;
      margin-bottom: 20px;
    }

    p {
      font-size: 18px;
      margin: 10px 0;
    }

    strong {
      color: #555;
    }

    a {
      display: inline-block;
      margin-top: 20px;
      text-decoration: none;
      background: #00b8b8;
      color: white;
      padding: 10px 20px;
      border-radius: 5px;
    }

    a:hover {
      background: #019090;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Booking Details</h2>
    <p><strong>Name:</strong> <?= htmlspecialchars($row['name']) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($row['email']) ?></p>
    <p><strong>Phone:</strong> <?= htmlspecialchars($row['phone']) ?></p>
    <p><strong>Age:</strong> <?= htmlspecialchars($row['age']) ?></p>
    <p><strong>Address:</strong> <?= htmlspecialchars($row['address']) ?></p>
    <a href="javascript:history.back()">Go Back</a>
  </div>
</body>
</html>
