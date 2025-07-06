<?php include 'connect.php';
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
  header("location:setting.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Signup - Sapana Hospital</title>
  <style>
    .hero{
      padding-top: 190px;
      padding-left:450px;
      
    }
    table {
      width: 100%;
      border-collapse: collapse;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
      background: #CCCCFF;
      border-radius: 12px;
      overflow: hidden;
      animation: fadeInUp 1s ease-out;
      /* width:80%; */
    }

    thead {
      background-color: #B0C4DE;
      color: white;
    }

    th, td {
      padding: 16px 20px;
      text-align: left;
      transition: background 0.3s ease;
    }

    tbody tr:hover {
      background-color:rgb(137, 178, 212);
      transform: scale(1.01);
      transition: all 0.3s ease-in-out;
      cursor: pointer;
    }

    tbody td {
      border-bottom: 1px solid #e0e0e0;
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(40px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <link rel="stylesheet" href="index.css" />
  
  <style>
    /* Bordered form */
form {
  border: 3px solid #f1f1f1;
}

/* Full-width inputs */
.{
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/* Set a style for all buttons */
button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

/* Add a hover effect for buttons */
button:hover {
  opacity: 0.8;
}

/* Extra style for the cancel button (red) */
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

/* Center the avatar image inside this container */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

/* Avatar image */
img.avatar {
  width: 40%;
  border-radius: 50%;
}

/* Add padding to containers */
.container {
  padding: 16px;
}

/* The "Forgot password" text */
span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
    display: block;
    float: none;
  }
  .cancelbtn {
    width: 100%;
  }
  </style>
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <img src="index.png" alt="Logo" />
            <span>Sapana Hospital</span>
        </div>
    </nav>

    <div class="animated-text">I am patient</div>


    <div class="hero">
      <table>
    <thead>
      <tr>
        <th>SNo</th>
        <th>Email</th>
        <th>Password</th>
        <th>Id</th>
        
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>example1@email.com</td>
        <td>••••••••</td>
        <td>001</td>
      </tr>
    </tbody>
  </table>
    </div>

</body>
</html>
