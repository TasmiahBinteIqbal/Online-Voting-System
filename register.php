<?php
$servername = "localhost";
$username = "root"; // Default username for XAMPP
$password = ""; // Default password for XAMPP
$dbname = "userdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    $message = "Connection failed: " . $conn->connect_error;
} else {
    $message = "";
}

// Check if form data is posted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $present_address = $_POST['present_address'];
    $permanent_address = $_POST['permanent_address'];
    $birth_id = $_POST['birth_id'];
    $birth_date = $_POST['birth_date'];
    $age = $_POST['age'];
    $fathers_name = $_POST['fathers_name'];
    $mothers_name = $_POST['mothers_name'];
    $marital_status = $_POST['marital_status'];
    $password = $_POST['password'];

    // Hash the password before saving (recommended for security)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO user (Full_Name, Email, Phone_Number, Present_Address, Permanent_Address, Birth_Id, Birth_Date, Age, Fathers_Name, Mothers_Name, Marital_Status, Password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssssss", $full_name, $email, $phone_number, $present_address, $permanent_address, $birth_id, $birth_date, $age, $fathers_name, $mothers_name, $marital_status, $hashed_password);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to index.html after successful registration
        header("Location: index.html");
        exit();
    } else {
        $message = "Error: " . $stmt->error;
    }

    // Close connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Result</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section>
        <div class="register-box">
            <h2>Register New Account</h2>
            <p id="result"></p>
            <a href="index.html">Go back to login page</a>
        </div>
    </section>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var message = <?php echo json_encode($message); ?>;
            if (message) {
                console.log(message);
                document.getElementById("result").innerText = message;
            }
        });
    </script>
</body>
</html>
