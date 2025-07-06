<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "suraj";

// connection
$conn = mysqli_connect($servername, $username, $password, $database);

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  header("location:adminlogin.php");
  exit;
}

// Check if ID is passed
if (!isset($_GET['id'])) {
  echo "Patient ID not provided.";
  exit;
}

$id = $_GET['id'];
$sql = "SELECT * FROM patient WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
$patient = mysqli_fetch_assoc($result);

if (!$patient) {
  echo "Patient not found.";
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Patient Details - Sapana Hospital</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(to right, #e0f7fa, #80deea);
      margin: 0;
      padding: 0;
      animation: fadeIn 1s ease-in;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .card {
      max-width: 550px;
      margin: 80px auto;
      background: linear-gradient(to right, #ffffff, #e0f2f1);
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
      animation: slideUp 0.8s ease-in-out;
    }

    @keyframes slideUp {
      from {
        opacity: 0;
        transform: translateY(40px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    h2 {
      text-align: center;
      color: #00695c;
      margin-bottom: 30px;
    }

    p {
      font-size: 18px;
      margin: 15px 0;
      color: #333;
    }

    p strong {
      color: #00796b;
    }

    a {
      display: inline-block;
      margin-top: 30px;
      text-decoration: none;
      background: #00796b;
      color: white;
      padding: 12px 25px;
      border-radius: 6px;
      font-size: 16px;
      transition: background 0.3s ease, transform 0.3s ease;
    }

    a:hover {
      background-color: #004d40;
      transform: scale(1.05);
    }

    @media screen and (max-width: 600px) {
      .card {
        margin: 40px 20px;
        padding: 20px;
      }

      h2 {
        font-size: 22px;
      }

      p {
        font-size: 16px;
      }
    }
  </style>
</head>
<body>
  <div class="card">
    <h2>Patient Details</h2>
    <p><strong>ID:</strong> <?php echo $patient['id']; ?></p>
    <p><strong>Email:</strong> <?php echo $patient['email']; ?></p>
    <!-- Add more patient fields here if needed -->
    <a href="patdetail.php">← Back to Patient List</a>
  </div>
</body>
</html>
