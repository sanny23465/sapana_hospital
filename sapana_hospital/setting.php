<?php
include 'connect.php';
session_start();

// Redirect if not logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  header("Location: login.php");
  exit;
}

// Get patient ID from session
$patient_id = $_SESSION['patient_id'];

$login = false;
$updated = false;
$row = null;

// Handle update form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  $sql = "UPDATE patient SET email='$email', password='$password' WHERE id='$patient_id'";
  if (mysqli_query($conn, $sql)) {
    $updated = true;
  }
}

// Fetch current user data
$sql = "SELECT * FROM patient WHERE id = '$patient_id'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) === 1) {
  $row = mysqli_fetch_assoc($result);
  $login = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Patient Settings - Sapana Hospital</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      animation: fadeIn 0.5s ease;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .hero {
      padding: 40px;
      display: flex;
      justify-content: center;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
      background: #CCCCFF;
      border-radius: 12px;
      overflow: hidden;
    }
    thead {
      background-color: #B0C4DE;
      color: white;
    }
    th, td {
      padding: 16px 20px;
      text-align: center;
    }
    tbody tr:hover {
      background-color: rgb(137, 178, 212);
      transition: all 0.3s ease-in-out;
    }
    .animated-text {
      color: #00b8b8;
      text-align: center;
      font-size: 50px;
      margin-top: 20px;
      animation: fadeInUp 1s ease;
    }
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .back-link {
      display: inline-block;
      margin: 15px 30px;
      font-size: 18px;
      color: #007bff;
      text-decoration: none;
      animation: fadeInLeft 1s ease;
    }
    .back-link:hover {
      text-decoration: underline;
    }
    @keyframes fadeInLeft {
      from { opacity: 0; transform: translateX(-30px); }
      to { opacity: 1; transform: translateX(0); }
    }
    #nav {
      background: #00b8b8;
    }
  </style>
</head>
<body>
  <nav class="navbar px-4" id="nav">
    <div class="d-flex align-items-center">
      <img src="index.png" alt="Logo" width="40" height="40" class="me-2" />
      <span class="fs-4 fw-bold">Sapana Hospital</span>
    </div>
  </nav>

  <a href="dash.php" class="back-link">← Back to Dashboard</a>

  <div class="animated-text">Your Profile</div>

  <?php if ($login && $row): ?>
    <div class="hero">
      <form method="post" class="w-75" action="setting.php">
        <?php if ($updated): ?>
          <div class="alert alert-success">Updated Successfully!</div>
        <?php endif; ?>
        <table class="table table-bordered text-center">
          <thead>
            <tr>
              <th>S.No</th>
              <th>Email</th>
              <th>Password</th>
              <th>ID</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td><input type="email" name="email" value="<?= htmlspecialchars($row['email']) ?>" class="form-control" required></td>
              <td><input type="text" name="password" value="<?= htmlspecialchars($row['password']) ?>" class="form-control" required></td>
              <td><input type="text" class="form-control" value="<?= htmlspecialchars($row['id']) ?>" disabled></td>
              <td><button type="submit" name="update" class="btn btn-success">Update</button></td>
            </tr>
          </tbody>
        </table>
      </form>
    </div>
  <?php endif; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
