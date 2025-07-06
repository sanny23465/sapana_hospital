<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "suraj";

// DB connection
$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$add = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $specialist = $_POST['specialist'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $sql = "INSERT INTO `doctor` (`id`, `Name`, `email`, `password`, `specialist`, `phone`, `date`) 
            VALUES ('$id', '$name', '$email', '$password', '$specialist', '$phone', current_timestamp())";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        $add = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Add Doctor - Sapana Hospital</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      margin: 0;
      padding-top: 65px;
      background: #f0faff;
      font-family: Arial, sans-serif;
    }

    /* Navbar styles (unchanged) */
    .navbar {
      position: fixed;
      top: 0;
      width: 100%;
      background: #00b8b8;
      color: white;
      padding: 10px 30px;
      display: flex;
      align-items: center;
      z-index: 999;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .navbar .logo {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .navbar .logo img {
      height: 38px;
      width: 38px;
      object-fit: contain;
    }

    .navbar .logo span {
      font-size: 1.2rem;
      font-weight: 600;
    }

    /* Form card container with purple-blue gradient & animation */
    .container.card-container {
      max-width: 520px;
      background: linear-gradient(135deg,rgb(174, 165, 190),rgb(27, 59, 80));
      padding: 30px 35px;
      margin: 30px auto;
      border-radius: 16px;
      box-shadow: 0 15px 40px rgba(126, 87, 194, 0.3);
      animation: fadeInUp 0.7s ease forwards;
      opacity: 0;
      transform: translateY(30px);
    }

    @keyframes fadeInUp {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Form labels for contrast */
    .card-container .form-label {
      color: #dcd6f7;
      font-weight: 600;
    }

    /* Inputs styling */
    .card-container .form-control {
      border-radius: 8px;
      border: 2px solid #9c84d1;
      background-color: rgba(255 255 255 / 0.85);
      color: #3a2e5a;
      transition: border-color 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease;
    }

    .card-container .form-control:focus {
      border-color: #b39ddb;
      box-shadow: 0 0 8px #b39ddb;
      background-color: white;
      outline: none;
    }

    /* Submit button */
    .card-container .btn-submit {
      background:rgb(94, 145, 212);
      color: #dcd6f7;
      font-weight: 700;
      border-radius: 10px;
      padding: 12px;
      width: 100%;
      transition: background 0.3s ease, color 0.3s ease;
      border: none;
      cursor: pointer;
      letter-spacing: 1.1px;
    }

    .card-container .btn-submit:hover {
      background:rgb(50, 114, 93);
      color: #fff;
    }

    /* Success alert */
    .alert-success {
      text-align: center;
      font-weight: 700;
      color: #4b3d99;
      background-color: #e1dfff;
      border-radius: 10px;
      padding: 12px;
      margin-bottom: 20px;
      box-shadow: 0 4px 10px rgba(126, 87, 194, 0.15);
      letter-spacing: 0.9px;
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

<!-- Content -->
<div class="container card-container">
  <?php if ($add): ?>
    <div class="alert alert-success">Doctor added successfully.</div>
  <?php endif; ?>

  <form action="add.php" method="POST">
    <div class="mb-3">
      <label class="form-label" for="name">Name</label>
      <input
        type="text"
        class="form-control"
        name="name"
        id="name"
        placeholder="Enter name"
        required
      />
    </div>

    <div class="mb-3">
      <label class="form-label" for="id">Doctor ID</label>
      <input
        type="text"
        class="form-control"
        name="id"
        id="id"
        placeholder="Enter doctor ID"
        required
      />
    </div>

    <div class="mb-3">
      <label class="form-label" for="email">Email</label>
      <input
        type="email"
        class="form-control"
        name="email"
        id="email"
        placeholder="Enter email"
        required
      />
    </div>

    <div class="mb-3">
      <label class="form-label" for="specialist">Specialist</label>
      <input
        type="text"
        class="form-control"
        name="specialist"
        id="specialist"
        placeholder="e.g. Cardiologist"
        required
      />
    </div>

    <div class="mb-3">
      <label class="form-label" for="phone">Phone</label>
      <input
        type="text"
        class="form-control"
        name="phone"
        id="phone"
        placeholder="Enter phone number"
        required
      />
    </div>

    <div class="mb-3">
      <label class="form-label" for="password">Password</label>
      <input
        type="password"
        class="form-control"
        name="password"
        id="password"
        placeholder="Enter password"
        required
      />
    </div>

    <button type="submit" class="btn btn-submit">Add Doctor</button>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
