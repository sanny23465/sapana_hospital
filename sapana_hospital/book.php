<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "suraj";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $age = (int)$_POST['age'];
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $doctor_id = mysqli_real_escape_string($conn, $_POST['doctor_id']);

    if (!$name || !$email || !$age || !$id || !$phone || !$address || !$doctor_id) {
        $message = "Please fill all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email format.";
    } else {
        $sql = "INSERT INTO booking (name, email, age, id, phone, address, doctor_id) 
                VALUES ('$name', '$email', $age, '$id', '$phone', '$address', '$doctor_id')";
        if (mysqli_query($conn, $sql)) {
            $message = "Booking successful!";
        } else {
            $message = "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Booking Form</title>
  <style>
    /* Reset some default browser styles */
    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
      background: #f4f9f9;
      color: #333;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .navbar {
      width: 100%;
      display: flex;
      align-items: center;
      padding: 15px 25px;
      background-color: #00b8b8;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
      margin-bottom: 30px;
    }

    .navbar img {
      width: 40px;
      height: 40px;
      margin-right: 15px;
    }

    .navbar span {
      color: white;
      font-size: 26px;
      font-weight: 700;
      letter-spacing: 1px;
    }

    h2 {
      text-align: center;
      margin-bottom: 25px;
      font-weight: 700;
      font-size: 28px;
      color: #007777;
      animation: fadeInDown 1s ease;
    }

    form {
      background: white;
      padding: 30px 30px 40px 30px;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
      max-width: 420px;
      width: 90%;
      animation: fadeInUp 1.2s ease;
      transition: box-shadow 0.3s ease;
    }

    form:hover {
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.18);
    }

    label {
      display: block;
      font-weight: 600;
      margin-bottom: 6px;
      color: #005757;
      font-size: 15px;
      user-select: none;
    }

    input[type="text"],
    input[type="email"],
    input[type="number"],
    input[type="tel"],
    textarea {
      width: 100%;
      padding: 12px 14px;
      margin-bottom: 18px;
      border: 1.8px solid #c4d4d4;
      border-radius: 8px;
      font-size: 16px;
      font-family: inherit;
      color: #004444;
      transition: border-color 0.3s ease;
      resize: vertical;
    }

    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="number"]:focus,
    input[type="tel"]:focus,
    textarea:focus {
      border-color: #00b8b8;
      outline: none;
      box-shadow: 0 0 8px rgba(0, 184, 184, 0.3);
    }

    button {
      width: 100%;
      padding: 14px;
      background: #00b8b8;
      border: none;
      border-radius: 10px;
      font-size: 18px;
      font-weight: 700;
      color: white;
      cursor: pointer;
      transition: background-color 0.25s ease;
      box-shadow: 0 5px 12px rgba(0, 184, 184, 0.4);
      user-select: none;
    }

    button:hover {
      background: #009a9a;
      box-shadow: 0 7px 18px rgba(0, 154, 154, 0.6);
    }

    .message {
      max-width: 420px;
      margin: 0 auto 30px auto;
      padding: 15px 20px;
      border-radius: 10px;
      font-weight: 700;
      font-size: 17px;
      text-align: center;
      animation: fadeIn 1s ease;
      user-select: none;
    }

    /* Success message */
    .message.success {
      color: #155724;
      background: #d4edda;
      border: 1.5px solid #c3e6cb;
    }

    /* Error message */
    .message.error {
      color: #721c24;
      background: #f8d7da;
      border: 1.5px solid #f5c6cb;
    }

    /* Animations */
    @keyframes fadeInUp {
      from {
        transform: translateY(30px);
        opacity: 0;
      }
      to {
        transform: translateY(0);
        opacity: 1;
      }
    }

    @keyframes fadeInDown {
      from {
        transform: translateY(-30px);
        opacity: 0;
      }
      to {
        transform: translateY(0);
        opacity: 1;
      }
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
      }
      to {
        opacity: 1;
      }
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <div class="navbar">
    <img src="index.png" alt="Logo" />
    <span>Sapana Hospital</span>
  </div>

  <!-- Booking Form -->
  <h2>Booking Form</h2>

  <?php if ($message): ?>
    <div class="message <?= strpos($message, 'Error') === false ? 'success' : 'error' ?>">
      <?= htmlspecialchars($message) ?>
    </div>
  <?php endif; ?>

  <form method="post" action="">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required />

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required />

    <label for="age">Age:</label>
    <input type="number" id="age" name="age" min="1" required />

    <label for="id">ID:</label>
    <input type="text" id="id" name="id" required />

    <label for="phone">Phone:</label>
    <input type="tel" id="phone" name="phone" required />

    <label for="address">Address:</label>
    <textarea id="address" name="address" rows="3" required></textarea>

    <label for="doctor_id">Doctor ID:</label>
    <input type="text" id="doctor_id" name="doctor_id" required />

    <button type="submit">Book Now</button>
  </form>
  
</body>
</html>
