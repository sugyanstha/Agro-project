<?php
// session_start();

// if (!isset($_SESSION['adminname'])) {
//     header("Location: adminlogin.php");
//     exit();
// }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/adashboard.css">
</head>
<body>
    <div id="header">
        <h1>Admin Dashboard</h1>
    </div>

    <div id="container">
        <div id="sidebar">
            <ul>
                <li><a href="main_content.php">Dashboard</a></li>
                <li><a href="#">Farmer Details</a></li>
                <li><a href="#">Farm Details</a></li>
                <li><a href="#">Counsellor Details</a></li>
                <li><a href="#">Predicament Details</a></li>
                <li><a href="#">Guidelines Details</a></li>
            </ul>
            <div id="logout">
                <a href="adminlogout.php">Logout</a>
            </div>
        </div>

        <div id="content">
            <h2>Welcome, Admin</h2>
            <p>This is the admin dashboard page.</p>
        </div>
    </div>

    <div id="footer">
        <p>&copy; 2023 Admin Dashboard. All rights reserved.</p>
    </div>
</body>
</html>

