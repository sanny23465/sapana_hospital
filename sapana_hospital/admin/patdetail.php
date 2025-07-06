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
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Dashboard - Sapana Hospital</title>
  <link rel="stylesheet" href="admin.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      animation: fadeBody 1s ease-in;
    }

    @keyframes fadeBody {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    #ll {
      background: #00b8b8;
    }

    .navbar {
      padding: 10px 20px;
      background-color: #fff;
      border-bottom: 1px solid #ccc;
      display: flex;
      align-items: center;
    }

    .logo {
      padding-left: 20px;
      display: flex;
      align-items: center;
    }

    .logo img {
      height: 40px;
      margin-right: 10px;
    }

    .logo span {
      font-size: 24px;
      font-weight: bold;
      color: white;
    }

    .kk {
      margin: 30px auto;
      width: 80%;
      text-align: center;
      padding-top: 90px;
    }

    #myInput {
      width: 300px;
      padding: 10px;
      margin-bottom: 20px;
      font-size: 16px;
      border-radius: 5px;
      border: 1px solid #ccc;
      transition: all 0.3s ease-in-out;
    }

    #myInput:focus {
      border-color: #00b8b8;
      box-shadow: 0 0 8px rgba(0, 184, 184, 0.6);
      outline: none;
    }

    table {
      margin: 0 auto;
      width: 100%;
      border-collapse: collapse;
      background-color: white;
      animation: fadeInTable 1s ease-in-out;
    }

    @keyframes fadeInTable {
      0% {
        opacity: 0;
        transform: translateY(20px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }

    th, td {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: left;
      transition: background 0.3s ease;
    }

    tr:hover {
      background-color: #f1f9f9;
    }

    th {
      background-color: #f2f2f2;
    }

    a {
      text-decoration: none;
      color: #007BFF;
      font-weight: bold;
      transition: color 0.3s ease;
    }

    a:hover {
      color: #0056b3;
    }
  </style>

  <script>
    $(document).ready(function(){
      // Live search
      $("#myInput").on("keyup", function(){
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function(){
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });

      // Fade in rows with delay
      $("#myTable tr").each(function(i){
        $(this).delay(100 * i).fadeIn(500);
      }).hide(); // Initially hidden
    });
  </script>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar" id="ll">
    <div class="logo">
      <img src="index.png" alt="Logo" />
      <span>Sapana Hospital</span>
    </div>
  </nav>

  <div class="kk">
    <input type="text" id="myInput" placeholder="Search patients...">
    <br><br>
    <table>
      <thead>
        <tr>
          <th>Sno</th>
          <th>Id</th>
          <th>Email</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="myTable">
        <?php
        $sql = "SELECT * FROM `patient`";
        $result = mysqli_query($conn, $sql);
        $s = 0;
        while($row = mysqli_fetch_assoc($result)){
          $s++;
          echo "<tr>
                  <td>{$s}</td>
                  <td>{$row['id']}</td>
                  <td>{$row['email']}</td>
                  <td><a href='viewpatient.php?id={$row['id']}'>View</a></td>
                </tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>
