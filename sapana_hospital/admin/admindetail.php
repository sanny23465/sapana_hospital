<?php
$servername="localhost";
$username="root";
$password="";
$database="suraj";
//connection 
$conn=mysqli_connect($servername, $username, $password, $database);

session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
  header("location:adminlogin.php");
//   exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin dash - Sapana Hospital</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <link rel="stylesheet" href="admin.css" />
  <style>
  .kanxi {
    padding-top: 190px;
    padding-left: 200px;
    width: 90%;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    font-family: Arial, sans-serif;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    animation: fadeIn 1s ease-in-out;
  }

  th {
    background-color: #2e86de;
    color: white;
    text-align: center;
    padding: 10px;
    font-size: 16px;
  }

  td {
    border: 1px solidrgb(22, 21, 21);
    text-align: center;
    padding: 10px;
    transition: background-color 0.3s ease;
  }

  tr:nth-child(even) {
    background-color: #f2f2f2;
  }

  tr:hover {
    background-color:rgb(66, 172, 145);
    transform: scale(1.01);
    transition: all 0.3s ease-in-out;
  }

  a.hero {
    color: #2e86de;
    font-weight: bold;
    text-decoration: none;
    transition: color 0.3s ease;
  }

  a.hero:hover {
    color: #1457a7;
    text-decoration: underline;
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
</style>

  <style>
    h1{
        /* text-align: center; */
        padding-top: 90px;
        padding-left: 200px;
        /* padding: 160px; */
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

  <div class="animated-text">I am Admin</div>
  <div class="kanxi">
    <table>
    <thead>
      <tr>
        <th>Sno</th>
        <!-- <th>Id</th> -->
        <!-- <th>Name</th> -->
        <th>Email</th>
        <!-- <th>Specialist</th> -->
        <!-- <th>Phone</th> -->
        <th>Password</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody id="myTable">
      <?php
  // INSERT INTO `doctor` (`sno`, `Name`, `email`, `password`, `specialist`, `phone`, `date`) VALUES (NULL, 'Shyamsunder', 'shyam@gmail.com', '8850', 'dentist', '9845622133', current_timestamp());
  $sql="SELECT * FROM `admin`";
  $result = mysqli_query($conn, $sql);
  $s=1;
  while($row = mysqli_fetch_assoc($result)){
    // $s+=1;
    echo "<tr>
        <td>" . $s ."</td>
        
        <td>". $row['email'] ."</td>
        <td>". $row['password'] ."</td>
        <td><a href='adminedit.php' class='hero'>Edit</a></td>

      </tr>";
  }
  ?>
  </tbody>
</table>
  </div>
</body>
</html>


