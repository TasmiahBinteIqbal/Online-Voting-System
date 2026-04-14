<?php
session_start();
error_reporting(0);

$servername = "localhost";
$username = "root"; // Default username for XAMPP
$password = ""; // Default password for XAMPP
$dbname = "userdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo "<script>alert('Connection error!');</script>";
    die("Connection failed: " . $conn->connect_error);
}

// Initialize error message
$error_message = "";

// Check if login form is submitted
if (isset($_POST['login'])) {
    $phone = $_POST['phone'];

    $stmt = $conn->prepare("SELECT fname, lname, idcard, status FROM voting WHERE phone = ?");
    $stmt->bind_param("s", $phone);

    // Execute statement
    $stmt->execute();
    $stmt->store_result();

    // Check if user exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($fname, $lname, $idcard, $status);
        $stmt->fetch();

        echo "<script>alert('Login Successfully!');</script>";

        $_SESSION['userLogin'] = 1;
        $_SESSION['phone'] = $phone;
        $_SESSION['fname'] = $fname;
        $_SESSION['lname'] = $lname;
        $_SESSION['idcard'] = $idcard;
        $_SESSION['status'] = $status;

        header("Location: voted.php");
        exit();
    } else {
        // User does not exist
        $_SESSION['error'] = "Phone number not registered";
        header("Location: votemat_index.php");
        exit();
    }
    $stmt->close();
} else {
    echo "<script>alert('Login form not submitted properly!');</script>";
}

$conn->close();
?>
