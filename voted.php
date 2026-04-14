<?php
session_start();
if ($_SESSION['userLogin'] != 1) {
    header("Location: votemat_index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voted Page</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- Include Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="heading">
            <h1>Welcome, <?php echo $_SESSION['fname'] . " " . $_SESSION['lname']; ?></h1>
        </div>
        <div class="container">
            <div class="header">
                <span class="logo">Voting System</span>
                <span class="profile" onclick="showProfile()">
                    <img src="<?php echo $_SESSION['idcard']; ?>" alt="">
                    <label><?php echo $_SESSION['fname'] . " " . $_SESSION['lname']; ?></label>
                </span>
            </div>
            <div id="profile-panel">
                <span class="fas fa-circle-xmark" onclick="hidePanel()"></span>
                <div class="dp"><img src="<?php echo $_SESSION['idcard']; ?>" alt=""></div>
                <div class="info">
                    <h2><?php echo $_SESSION['fname'] . " " . $_SESSION['lname']; ?></h2>
                </div>
                <p>Your phone number: <?php echo $_SESSION['phone']; ?></p>
                <p>Status: <?php echo $_SESSION['status']; ?></p>
            
            <div class="link">
                <a href="includes/user-logout.php" class="del"><i class="fas fa-arrow-right-from-bracket"></i> Logout</a>
            </div>
        </div>
        </div>
    </div>
    <script src="js/script.js"></script>
</body>
</html>
