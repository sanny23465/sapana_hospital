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
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Dash - Sapana Hospital</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" href="admin.css" />
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script>
    $(document).ready(function(){
      $("#myInput").on("keyup", function(){
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function(){
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
  </script>
  <style>
    .table-container {
      max-height: 400px;
      overflow-y: auto;
    }
    thead th {
      position: sticky;
      top: 0;
      background-color: #f8f9fa; /* Bootstrap light background */
      z-index: 1;
    }
    #rr{
        background: #00b8b8;
    }
    #raka{
        color:white;
        font-size:24px;
    }
    #dhaka{
      padding-left:23px;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar px-4" id="rr">
  <div class="d-flex align-items-center" id="dhaka">
    <img src="index.png" alt="Logo" width="40" height="40" class="me-2" />
    <span class="h5 mb-0" id="raka"><b>Sapana Hospital</b></span>
  </div>
</nav>

<!-- Main Content -->
<div class="container mt-5">
  <h1 class="mb-4"><u>Book your Appointment</u></h1>

  <!-- Alert Message -->
  <?php if (isset($_GET['msg'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <?php echo htmlspecialchars($_GET['msg']); ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>

  <!-- Search Field -->
  <div class="d-flex justify-content-start align-items-center mb-3">
    <input type="text" id="myInput" class="form-control w-25" placeholder="Search doctor...">
  </div>

  <!-- Scrollable Doctor Table -->
  <div class="table-container">
    <table class="table table-bordered table-hover mb-0">
      <thead class="table-light">
        <tr>
          <th>Sno</th>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Specialist</th>
          <th>Phone</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="myTable">
        <?php
        $sql = "SELECT * FROM `doctor`";
        $result = mysqli_query($conn, $sql);
        $s = 0;
        while ($row = mysqli_fetch_assoc($result)) {
          $s++;
          echo "<tr>
                  <td>$s</td>
                  <td>{$row['id']}</td>
                  <td>{$row['Name']}</td>
                  <td>{$row['email']}</td>
                  <td>{$row['specialist']}</td>
                  <td>{$row['phone']}</td>
                  <td>
                    <a href='view.php?id={$row['id']}' class='btn btn-sm btn-info'>View</a>
                    <a href='book.php?id={$row['id']}' class='btn btn-sm btn-success'>Book</a>
                  </td>
                </tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>
</html>
