<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'connect.php';
session_start();

// Redirect if not logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

if (!isset($_SESSION['patient_id'])) {
    die("Error: patient_id not found in session.");
}

$patient_id = intval($_SESSION['patient_id']);

// Fetch bookings for this patient
$sql = "SELECT 
          b.*, 
          d.Name AS doctor_name, 
          d.email AS doctor_email, 
          d.phone AS doctor_phone, 
          d.specialist,
          d.time AS doctor_time
        FROM booking b
        LEFT JOIN doctor d ON b.doctor_id = d.id
        WHERE b.id = $patient_id
        ORDER BY b.id DESC";

$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Patient Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #f4f6f9;
      font-family: 'Segoe UI', Tahoma, sans-serif;
      padding: 30px;
    }
    h2 {
      color: #007b7b;
      font-weight: 700;
      margin-bottom: 30px;
    }
    .booking-section {
      margin-bottom: 40px;
    }
    .card {
      margin-bottom: 20px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
      border-left: 5px solid #00b8b8;
    }
    .card-header {
      background-color: #00b8b8;
      color: white;
      font-weight: bold;
    }
    .label {
      font-weight: 600;
    }
    .status {
      font-weight: 600;
      padding: 6px 12px;
      border-radius: 6px;
      display: inline-block;
      text-transform: capitalize;
      font-size: 14px;
    }
    .accepted {
      color: #155724;
      background: #d4edda;
      border: 1px solid #c3e6cb;
    }
    .rejected {
      color: #721c24;
      background: #f8d7da;
      border: 1px solid #f5c6cb;
    }
    .pending {
      color: #856404;
      background: #fff3cd;
      border: 1px solid #ffeeba;
    }
  </style>
</head>
<body>

  <h2>Your Bookings</h2>

  <?php if (mysqli_num_rows($result) > 0): ?>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
      <?php
        $status = $row['status'] ?? 'pending';
        $statusClass = htmlspecialchars($status);
      ?>
      <div class="booking-section">
        <div class="row">
          <!-- Doctor Card -->
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">Doctor Details</div>
              <div class="card-body">
                <p><span class="label">Name:</span> <?= htmlspecialchars($row['doctor_name']) ?></p>
                <p><span class="label">Specialist:</span> <?= htmlspecialchars($row['specialist']) ?></p>
                <p><span class="label">Email:</span> <?= htmlspecialchars($row['doctor_email']) ?></p>
                <p><span class="label">Phone:</span> <?= htmlspecialchars($row['doctor_phone']) ?></p>
                <p><span class="label">Time:</span> <?= htmlspecialchars($row['doctor_time']) ?></p>
              </div>
            </div>
          </div>

          <!-- Patient Card -->
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">Your Details</div>
              <div class="card-body">
                <p><span class="label">Name:</span> <?= htmlspecialchars($row['name']) ?></p>
                <p><span class="label">Email:</span> <?= htmlspecialchars($row['email']) ?></p>
                <p><span class="label">Phone:</span> <?= htmlspecialchars($row['phone']) ?></p>
                <p><span class="label">Age:</span> <?= htmlspecialchars($row['age']) ?></p>
                <p><span class="label">Address:</span> <?= htmlspecialchars($row['address']) ?></p>
              </div>
            </div>
          </div>
        </div>

        <!-- Booking Status -->
        <div class="mt-2">
          <span class="label">Status:</span> 
          <span class="status <?= $statusClass ?>"><?= ucfirst($status) ?></span>
        </div>
        <hr />
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <p>No bookings found.</p>
  <?php endif; ?>

</body>
</html>
