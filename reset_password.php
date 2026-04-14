<?php
$servername = "localhost";
$username = "root"; // Default username for XAMPP
$password = ""; // Default password for XAMPP
$dbname = "userdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is posted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $email = $_POST['email'];
    $birth_id = $_POST['birth_id'];
    $new_password = $_POST['new_password'];

    // Hash the new password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Check if the email and birth ID match a record in the database
    $stmt = $conn->prepare("SELECT * FROM user WHERE Email = ? AND Birth_Id = ?");
    $stmt->bind_param("ss", $email, $birth_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User found, update the password
        $update_stmt = $conn->prepare("UPDATE user SET Password = ? WHERE Email = ? AND Birth_Id = ?");
        $update_stmt->bind_param("sss", $hashed_password, $email, $birth_id);

        if ($update_stmt->execute()) {
            // Redirect to index.html after successful password reset
            header("Location: index.html");
            exit();
        } else {
            $message = "Error updating password: " . $update_stmt->error;
        }
        $update_stmt->close();
    } else {
        $message = "Invalid email or birth ID.";
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
    <title>Reset Password Result</title>
    <link rel="stylesheet" href="forget_pass.css">
</head>
<body>
    <section>
        <div class="reset-box">
            <h2>Reset Password</h2>
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
