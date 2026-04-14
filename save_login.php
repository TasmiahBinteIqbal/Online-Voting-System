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

// Initialize error message
$error_message = "";

// Check if form data is posted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT Password FROM user WHERE Email = ?");
    $stmt->bind_param("s", $email);

    // Execute statement
    $stmt->execute();
    $stmt->store_result();

    // Check if user exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        // Verify password
        if (password_verify($password, $hashed_password)) {
            // Password is correct, start a session and set a flag for redirection
            session_start();
            $_SESSION['email'] = $email;
            $redirect = true;
        } else {
            // Password is incorrect
            $error_message = "Invalid email or password";
        }
    } else {
        // User does not exist
        $error_message = "Invalid email or password";
    }
    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Please Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <section>
        <div class="login-box">
            <form action="save_login.php" method="post">
                <h2>You Have to Login First</h2>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="mail-outline"></ion-icon></span>
                    <input type="email" name="email" required>
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed-outline"></ion-icon></span>
                    <input type="password" name="password" required>
                    <label>Password</label>
                </div>
                <div id="error-message" class="error-message">
                    <!-- Error message will be shown here -->
                    <?php if (isset($error_message)) echo $error_message; ?>
                </div>
                <div class="remeber-forget">
                    <label><input type="checkbox">Remember me </label>
                    <a href="reset_password.html">Forgot Password?</a>
                </div>
                <button type="submit">Login</button>
                <div class="register-link">
                    <p>Don't have an account?<a href="register.html"> Register</a></p>
                </div>
            </form>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script>
        <?php if (isset($redirect) && $redirect): ?>
        // Redirect to homepage using JavaScript
        window.location.href = 'votemat_index.php';
        <?php endif; ?>
    </script>
</body>

</html>
