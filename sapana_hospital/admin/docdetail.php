<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "suraj";

// Connect
$conn = mysqli_connect($servername, $username, $password, $database);
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location:adminlogin.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin dash - Sapana Hospital</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script>
    $(document).ready(function(){
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
  </script>
  <style>
    body {
      margin: 0;
      padding-top: 70px; /* space for fixed navbar */
    }

    .navbar {
      position: fixed;
      top: 0;
      width: 100%;
      background: #00b8b8;
      color: white;
      padding: 10px 30px;
      display: flex;
      align-items: center;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      z-index: 999;
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
      font-size: 1.25rem;
      font-weight: bold;
    }

    .add {
      color: #007bff;
      font-weight: bold;
      text-decoration: none;
      float: right;
      margin-top: -36px;
      margin-right: 10px;
      transition: color 0.3s ease;
    }

    .add:hover {
      color: #0056b3;
    }

    .hero {
      padding: 4px 10px;
      margin-right: 5px;
      border-radius: 4px;
      font-weight: 600;
      cursor: pointer;
      text-decoration: none;
    }

    .hero.edit {
      background-color: #28a745;
      color: white;
    }

    .hero.edit:hover {
      background-color: #1e7e34;
    }

    .hero.delete {
      background-color: #dc3545;
      color: white;
    }

    .hero.delete:hover {
      background-color: #a71d2a;
    }

    #myInput {
      width: 300px;
      display: inline-block;
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

  <!-- Main Content -->
  <div class="main-content container">
    <h2 class="mb-3 mt-4"><u>Detail of All Doctors</u></h2>

    <!-- Search and Add Button -->
    <input type="text" id="myInput" class="form-control mb-3" placeholder="Search...">
    <a href="add.php" class="add">Add +</a>

    <!-- Table -->
    <table class="table table-bordered">
      <thead class="table-dark">
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
        $sql = "SELECT * FROM doctor";
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
                      <a href='edit.php?id={$row['id']}' class='hero edit'>Edit</a>
                      <a href='delete.php?id={$row['id']}' class='hero delete' onclick=\"return confirm('Are you sure you want to delete this doctor?');\">Delete</a>
                    </td>
                  </tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>
