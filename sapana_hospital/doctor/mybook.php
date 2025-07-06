<?php 
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "suraj";
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();

// Check if doctor is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || !isset($_SESSION['doctor_id'])) {
  header("location:login.php");
  exit;
}

$doctor_id = intval($_SESSION['doctor_id']); // Get doctor ID from session

// Handle Accept/Reject actions
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $action = $_GET['action'];

    // Ensure the booking belongs to the logged-in doctor
    $check_sql = "SELECT * FROM booking WHERE id = $id AND doctor_id = $doctor_id";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        if ($action === 'accept') {
            $update_sql = "UPDATE booking SET status='accepted' WHERE id=$id";
        } elseif ($action === 'reject') {
            $update_sql = "UPDATE booking SET status='rejected' WHERE id=$id";
        }

        if (isset($update_sql)) {
            mysqli_query($conn, $update_sql);
        }
    }

    header("Location: " . basename($_SERVER['PHP_SELF']));
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Doctor Dashboard - Sapana Hospital</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f6f9;
      margin: 0;
      padding: 0;
    }

    .navbar {
      background-color: #00b8b8;
      padding: 18px 30px;
      color: white;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .navbar .logo {
      display: flex;
      align-items: center;
    }

    .navbar .logo img {
      height: 42px;
      margin-right: 12px;
    }

    .navbar .logo span {
      font-size: 26px;
      font-weight: bold;
    }

    .container {
      padding: 30px;
    }

    .table-container {
      max-height: 450px;
      overflow-y: auto;
      border-radius: 8px;
      margin-top: 30px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
      background-color: white;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      min-width: 900px;
    }

    th, td {
      padding: 14px 18px;
      text-align: left;
      border-bottom: 1px solid #e1e1e1;
    }

    th {
      background-color: #00b8b8;
      color: white;
      position: sticky;
      top: 0;
      z-index: 1;
    }

    .status {
      font-weight: bold;
      padding: 6px 10px;
      border-radius: 6px;
      display: inline-block;
      text-transform: capitalize;
      font-size: 15px;
    }

    .accepted {
      color: #155724;
      background-color: #d4edda;
      border: 1px solid #c3e6cb;
    }

    .rejected {
      color: #721c24;
      background-color: #f8d7da;
      border: 1px solid #f5c6cb;
    }

    .pending {
      color: #856404;
      background-color: #fff3cd;
      border: 1px solid #ffeeba;
    }

    .btn {
      padding: 8px 14px;
      font-size: 14px;
      font-weight: 600;
      border: none;
      border-radius: 5px;
      text-decoration: none;
      color: white;
      margin-right: 8px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .btn.accept {
      background-color: #3498db;
    }

    .btn.accept:hover {
      background-color: #217dbb;
    }

    .btn.reject {
      background-color: #e74c3c;
    }

    .btn.reject:hover {
      background-color: #c0392b;
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

  <div class="container">
    <h2>Your Bookings</h2>
    <?php
    $sql = "SELECT * FROM booking WHERE doctor_id = $doctor_id ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        echo "<p>Error fetching bookings: " . mysqli_error($conn) . "</p>";
    } elseif (mysqli_num_rows($result) > 0) {
      echo "<div class='table-container'><table>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Age</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>";
      while ($row = mysqli_fetch_assoc($result)) {
        $status = !empty($row['status']) ? $row['status'] : 'pending';
        $statusClass = htmlspecialchars($status);

        echo "<tr>
                <td>" . htmlspecialchars($row['name']) . "</td>
                <td>" . htmlspecialchars($row['email']) . "</td>
                <td>" . htmlspecialchars($row['age']) . "</td>
                <td>" . htmlspecialchars($row['phone']) . "</td>
                <td>" . htmlspecialchars($row['address']) . "</td>
                <td><span class='status {$statusClass}'>" . htmlspecialchars($status) . "</span></td>
                <td>";
        if ($status === 'pending') {
          echo "<a class='btn reject' href='?action=reject&id={$row['id']}' onclick=\"return confirm('Reject this booking?');\">Reject</a>
                <a class='btn accept' href='?action=accept&id={$row['id']}' onclick=\"return confirm('Accept this booking?');\">Accept</a>";
        } else {
          echo "—";
        }
        echo "</td></tr>";
      }
      echo "</table></div>";
    } else {
      echo "<p>No bookings found.</p>";
    }
    ?>
  </div>
</body>
</html>
