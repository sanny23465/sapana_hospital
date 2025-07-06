<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "suraj";

// DB connection
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

// Handle update form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $specialist = mysqli_real_escape_string($conn, $_POST['specialist']);

    $sql = "UPDATE doctor SET email='$email', Name='$name', phone='$phone', specialist='$specialist', password='$password' WHERE id='$doctor_id'";
    if (mysqli_query($conn, $sql)) {
        $updated = true;
    }
}

// Fetch doctor data
$sql = "SELECT * FROM doctor WHERE id = '$doctor_id'";
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
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Doctor Settings - Sapana Hospital</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      animation: fadeIn 0.5s ease;
      background: #f4faff;
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
      width: 90%;
      margin: auto;
      border-collapse: collapse;
      background: linear-gradient(135deg, #f3f9ff, #dbefff);
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }

    thead {
      background: linear-gradient(to right, #007bff, #00c6ff);
      color: white;
      font-weight: bold;
    }

    th, td {
      padding: 16px;
      text-align: center;
      border: 1px solid #ccc;
    }

    tbody tr {
      transition: background-color 0.3s ease;
    }

    tbody tr:nth-child(even) {
      background-color: #f0f8ff;
    }

    tbody tr:nth-child(odd) {
      background-color: #e0f0ff;
    }

    tbody tr:hover {
      background-color: #cdeaff;
    }

    input.form-control {
      background-color: #fff;
      border-radius: 8px;
    }

    .form-container {
      margin: 40px auto;
      width: 50%;
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

    .btn-success {
      border-radius: 8px;
    }
  </style>
</head>
<body>
  <nav class="navbar px-4" id="nav">
    <div class="d-flex align-items-center">
      <img src="index.png" alt="Logo" width="40" height="40" class="me-2" />
      <span class="fs-4 fw-bold text-white">Sapana Hospital</span>
    </div>
  </nav>

  <a href="docdash.php" class="back-link">← Back to Dashboard</a>
  <div class="animated-text">Doctor Settings</div>

  <div class="hero">
    <form method="post" class="w-100" action="setting.php">
      <?php if ($updated): ?>
        <div class="alert alert-success text-center">Updated Successfully!</div>
      <?php endif; ?>
      <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>">
      <table class="table table-bordered text-center">
        <thead>
          <tr>
            <th>S.No</th>
            <th>Email</th>
            <th>Name</th>
            <th>Password</th>
            <th>Phone</th>
            <th>ID</th>
            <th>Specialist</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td><input type="email" name="email" value="<?= htmlspecialchars($row['email']) ?>" class="form-control" required></td>
            <td><input type="text" name="name" value="<?= htmlspecialchars($row['Name']) ?>" class="form-control" required></td>
            <td><input type="text" name="password" value="<?= htmlspecialchars($row['password']) ?>" class="form-control" required></td>
            <td><input type="text" name="phone" value="<?= htmlspecialchars($row['phone']) ?>" class="form-control" required></td>
            <td><input type="text" class="form-control" value="<?= htmlspecialchars($row['id']) ?>" readonly></td>
            <td><input type="text" name="specialist" value="<?= htmlspecialchars($row['specialist']) ?>" class="form-control" required></td>
            <td><button type="submit" name="update" class="btn btn-success">Update</button></td>
          </tr>
        </tbody>
      </table>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
