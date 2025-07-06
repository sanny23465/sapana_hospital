<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "suraj";

// Connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Session check
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  header("location:adminlogin.php");
}

$update = false;
$email = '';
$pass = '';

// Fetch existing data
$sql = "SELECT * FROM `admin` WHERE `sno` = 1";
$result = mysqli_query($conn, $sql);
if ($row = mysqli_fetch_assoc($result)) {
  $email = $row['email'];
  $pass = $row['password'];
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = $_POST['email'];
  $pass = $_POST['password'];

  $sql = "UPDATE `admin` SET `email` = '$email', `password` = '$pass' WHERE `sno` = 1";
  if (mysqli_query($conn, $sql)) {
    $update = true;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Edit Admin - Sapana Hospital</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    #kk {
      background: #00b8b8;
    }
    #ff {
      color: white;
      font-size: 24px;
      padding-left: 12px;
    }
    #lll {
      padding-left: 12px;
    }
    form {
      padding-top: 100px;
      margin: auto;
      width: 50%;
      border: 3px solid #f1f1f1;
      padding: 30px;
      background-color: #f9f9f9;
      border-radius: 10px;
    }
    .jj {
      width: 100%;
      padding: 12px;
      margin: 8px 0;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }
    button {
      background-color: #04AA6D;
      color: white;
      padding: 14px 20px;
      border: none;
      cursor: pointer;
      width: 100%;
      font-weight: bold;
    }
    button:hover {
      opacity: 0.9;
    }
    .animated-text {
      text-align: center;
      font-size: 32px;
      font-weight: bold;
      padding-top: 60px;
      color: #2e86de;
      animation: fadeIn 2s ease-in-out;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .modal-backdrop.show {
      backdrop-filter: blur(3px);
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar px-4" id="kk">
    <div class="logo d-flex align-items-center gap-2" id="lll">
      <img src="index.png" alt="Logo" width="40" height="40" />
      <span class="fw-bold" id="ff">Sapana Hospital</span>
    </div>
  </nav>

  <!-- Success Modal (over I am Admin) -->
  <?php if ($update): ?>
  <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title" id="successModalLabel">Success</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
          Admin details updated successfully!
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>

  <!-- I am Admin Text -->
  <div class="animated-text">I am Admin</div>

  <!-- Edit Form -->
  <form method="post">
    <div class="container">
      <label for="email"><b>Email</b></label>
      <input type="email" class="jj" name="email" value="<?php echo htmlspecialchars($email); ?>" required>

      <label for="password"><b>Password</b></label>
      <input type="text" class="jj" name="password" value="<?php echo htmlspecialchars($pass); ?>" required>

      <button type="submit">Update</button>
    </div>
  </form>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

  <?php if ($update): ?>
  <script>
    const modal = new bootstrap.Modal(document.getElementById('successModal'));
    modal.show();
    setTimeout(() => {
      modal.hide();
    }, 3000);
  </script>
  <?php endif; ?>
</body>
</html>
