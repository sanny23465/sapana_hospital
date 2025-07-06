<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "suraj";

// Connect
$conn = mysqli_connect($servername, $username, $password, $database);
session_start();

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location:adminlogin.php");
    exit;
}

$update = false;
$row = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM doctor WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "<div class='alert alert-danger'>Doctor not found.</div>";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $specialist = $_POST['specialist'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $sql = "UPDATE doctor SET Name='$name', email='$email', specialist='$specialist', phone='$phone', password='$password' WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        $update = true;
        $result = mysqli_query($conn, "SELECT * FROM doctor WHERE id = '$id'");
        $row = mysqli_fetch_assoc($result);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit Doctor - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h2>Edit Doctor Information</h2>
  <a href="docdetail.php" class="btn btn-secondary mb-3">← Back to List</a>

  <?php if ($update): ?>
    <div class="alert alert-success">Doctor details updated successfully.</div>
  <?php endif; ?>

  <?php if ($row): ?>
    <form method="post" action="edit.php?id=<?= htmlspecialchars($row['id']) ?>">
      <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>">

      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($row['Name']) ?>" required>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($row['email']) ?>" required>
      </div>

      <div class="mb-3">
        <label for="specialist" class="form-label">Specialist</label>
        <input type="text" class="form-control" name="specialist" value="<?= htmlspecialchars($row['specialist']) ?>" required>
      </div>

      <div class="mb-3">
        <label for="phone" class="form-label">Phone</label>
        <input type="text" class="form-control" name="phone" value="<?= htmlspecialchars($row['phone']) ?>" required>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="text" class="form-control" name="password" value="<?= htmlspecialchars($row['password']) ?>" required>
      </div>

      <button type="submit" class="btn btn-primary">Update</button>
    </form>
  <?php endif; ?>
</div>
</body>
</html>
