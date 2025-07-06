<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "suraj";

// Connection 
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
  <title>Admin Dash - Sapana Hospital</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom Styles -->
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f0f2f5;
    }

    .navbar {
      display: flex;
      align-items: center;
      padding: 10px 30px;
      background-color: #00b8b8;
      color: white;
    }

    .logo img {
      height: 40px;
      margin-right: 10px;
    }

    .logo span {
      font-size: 24px;
      font-weight: bold;
    }

    .animated-text {
      text-align: center;
      font-size: 28px;
      font-weight: bold;
      color: #333;
      margin-top: 30px;
      animation: slideIn 1s ease;
    }

    .hero {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 70vh;
      animation: fadeIn 1.2s ease-in-out;
    }

    .table {
      width: 80%;
      max-width: 800px;
      background-color: white;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      animation: slideUp 1s ease;
    }

    /* Animations */
    @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.95); }
      to { opacity: 1; transform: scale(1); }
    }

    @keyframes slideUp {
      from { opacity: 0; transform: translateY(50px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes slideIn {
      from { opacity: 0; transform: translateY(-30px); }
      to { opacity: 1; transform: translateY(0); }
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

  <!-- Animated Title -->
  <div class="animated-text">Neurologist</div>

  <!-- Centered Table with Animation -->
  <div class="hero">
    <table class="table table-striped table-hover text-center">
      <thead class="table-primary">
        <tr>
          <th scope="col">Sno</th>
          <th scope="col">Id</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Phone</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql="SELECT * FROM `doctor` WHERE `specialist` = 'neurologist'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        $sno=0;
        if($num>1){
          while($row=mysqli_fetch_assoc($result)){
            $sno+=1;
            echo "<tr>
          <td>". $sno ."</th>
          <td>". $row['id'] ."</td>
          <td>". $row['Name'] ."</td>
          <td>". $row['email'] ."</td>
          <td>". $row['phone'] ."</td>
        </tr>";
          }
        }
        ?>
      </tbody>
    </table>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
