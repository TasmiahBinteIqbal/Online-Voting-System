<?php
session_start();
session_destroy();
error_reporting(0);
$_SESSION['userLogin'] = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Voting System</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <div class="heading">
            <h1>Online Voting System</h1>
        </div>
        <div class="form">
            <h4>Voter Login</h4>
            <form action="voter_login_data.php" method="POST">
                <label class="label">Phone Number:</label>
                <input type="number" name="phone" id="" class="input" placeholder="Enter Phone Number" required>
                <button class="button" type="submit" name="login">Login</button>
                <div class="link1">New user ? <a href="votemat_registration.php">Register here</a></div>
                <!-- <div class="link1">Change Mobile Number ? <a href="lost_phone.php">Send Request</a></div> -->
            </form>
            <p class="error"><?php echo $_SESSION['error']; ?></p>
        </div>

        <div style="position: absolute; top: 0; right: 0;
    margin: 10px; /* Add some margin if needed */">
    <a href="project1/index.php" target="_blank" style="color: white; font:bolder; font-size:x-large;">Admin Login</a></div>
    </div>
</body>

</html>