<!-- INSERT INTO `admin` (`sno`, `email`, `password`, `date`) VALUES ('1', 'sapanaadmin@gmail.com', '8848', current_timestamp()); -->
<?php
$servername="localhost";
$username="root";
$password="";
$database="suraj";

//connection
$conn = mysqli_connect($servername, $username, $password, $database);
$login=false;
$notlog=false;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $email = $_POST['email'];
  $password = $_POST['password'];
  $sql = "Select * from admin where email='$email' AND password='$password'";
  $result = mysqli_query($conn, $sql);
  $num=mysqli_num_rows($result);
  if($num==1){
    $login = true;
    session_start();
    $_SESSION['loggedin'] = true;
    $_SESSION['email'] = $email;
    header("location:admindash.php");
  }
  else{
    $notlog = true;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - Sapana Hospital</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <link rel="stylesheet" href="admin.css" />
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar">
    <div class="logo">
      <img src="index.png" alt="Logo" />
      <span>Sapana Hospital</span>
    </div>
    <div class="nav-links">
      <!-- <a href="/sapana_hospital">Signup</a> -->
      <a href="/sapana_hospital/admin/adminlog.php">Login</a>
    </div>
  </nav>
 

  <!-- Background -->
  <div class="background"></div>


  <!-- Animated Text -->
  <div class="animated-text">I am admin</div>

  <!-- Signup Form (no table used) -->
  <div class="form-container">
    <h2>Login</h2>
    <form method="post" action="">
      
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required />
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Max 8 characters" required />
      </div>
      <div class="form-group center">
        <button type="submit">Login</button>
      </div>
    </form>
       <?php
   if($login){
    echo '<div class="alert alert-info" role="alert">
    Your email is login successfullty.</div>';
  } 
  ?>
  <?php
  if($notlog){
    echo '<div class="alert alert-info" role="alert">
    Inavlid!
    </div>';
  }
  ?>
  </div>

  <script src="admin.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" integrity="sha384-7qAoOXltbVP82dhxHAUje59V5r2YsVfBafyUDxEdApLPmcdhBPg1DKg1ERo0BZlK" crossorigin="anonymous"></script>
</body>
</html>
