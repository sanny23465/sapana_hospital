<?php include 'connect.php';
$signup=false;
$notsign=false;
if($_SERVER["REQUEST_METHOD"]=="POST"){
  $email = $_POST['email'];
  $id = $_POST['id'];
  $password = $_POST['password'];
  $cpassword = $_POST['cpassword'];

  if($password == $cpassword){
    $sql = "INSERT INTO `patient` (`email`, `id`, `password`, `date`) VALUES ('$email', '$id', '$password', current_timestamp())";
    $result = mysqli_query($conn, $sql);
    if($result){
      $signup = true;
    }
    else{
      $notsign = true;
    }
  }
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Signup - Sapana Hospital</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <link rel="stylesheet" href="index.css" />
  <style>
    body, html {
      height: 100%;
      margin: 0;
      padding: 0;
    }

    .form-container {
      position: absolute;
      top: 60%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: rgba(255, 255, 255, 0.95);
      padding: 20px 25px; /* Reduced padding */
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: 90%;
      max-width: 400px;
    }

    .form-group {
      margin-bottom: 12px; /* Reduced spacing */
    }

    .form-group label {
      font-weight: 600;
      display: block;
      margin-bottom: 5px;
    }

    .form-group input {
      width: 100%;
      padding: 6px 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    .form-group.center {
      text-align: center;
    }

    .form-group button {
      padding: 8px 20px;
      background-color:rgb(58, 132, 206);
      color: white;
      border: none;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    .form-group button:hover {
      background-color: #007d7d;
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
    <div class="nav-links">
      <a href="/sapana_hospital">Signup</a>
      <a href="/sapana_hospital/login.php">Login</a>
    </div>
  </nav>

  <!-- Background -->
  <div class="background"></div>

  <!-- Animated Text -->
  <div class="animated-text">I am patient</div>

  <!-- Signup Form (no table used) -->
  <div class="form-container">
    <h2>Signup</h2>
    <form method="POST" action="/sapana_hospital/index.php" onsubmit="return validateForm()">
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required/>
      </div>
      <div class="form-group">
        <label for="Id">Id</label>
        <input type="text" id="Id" name="id" placeholder="Enter unique Id" required/>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Max 8 characters" required/>
      </div>
      <div class="form-group">
        <label for="confirm">Confirm Password</label>
        <input type="password" id="confirm" name="cpassword" placeholder="Re-enter password" required/>
      </div>
      <div class="form-group center">
        <button type="submit">Sign Up</button>
      </div>
    </form>
     <?php
     if($signup){
      echo '<div class="alert alert-info" role="alert">Your email is signup successfully.</div>';
    } 
    ?>

  <?php
  if($notsign){
    echo '<div class="alert alert-info" role="alert">Password do not match!</div>';
  }
  ?>
  </div>

  <script>
function validateForm() {
  const password = document.getElementById('password').value;

  if (password.length <= 5) {
    alert("Password must be more than 5 characters.");
    return false;
  }

  return true; // allow form to submit
}
</script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" integrity="sha384-7qAoOXltbVP82dhxHAUje59V5r2YsVfBafyUDxEdApLPmcdhBPg1DKg1ERo0BZlK" crossorigin="anonymous"></script>
</body>
</html>
