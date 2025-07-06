<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "suraj";

// Connect to database
$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitize the ID

    // Delete query
    $sql = "DELETE FROM doctor WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: docdetail.php"); // Redirect back to dashboard
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    echo "Invalid Request";
}
?>
<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: adminlogin.php");
    exit;
}
?>
