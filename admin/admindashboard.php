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
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        #header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        #container {
            display: flex;
            margin: 20px;
        }

        #sidebar {
            width: 250px;
            background-color: #f2f2f2;
            padding: 20px;
        }

        #content {
            flex-grow: 1;
            padding: 20px;
            background-color: #fff;
        }

        #footer {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        #sidebar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        #sidebar ul li {
            margin-bottom: 10px;
        }

        #sidebar ul li a {
            text-decoration: none;
            color: #333;
        }

        #sidebar ul li a:hover {
            color: #000;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div id="header">
        <h1>Admin Dashboard</h1>
    </div>

    <div id="container">
        <div id="sidebar">
            <ul>
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Users</a></li>
                <li><a href="#">Products</a></li>
                <li><a href="#">Orders</a></li>
                <li><a href="#">Settings</a></li>
                <li><a href="adminlogout.php">Logout</a></li>
            </ul>
        </div>

        <div id="content">
            <h2>Welcome, Admin</h2>
            <p>This is the admin dashboard page. You can customize this page as per your requirements and add more functionality.</p>
        </div>
    </div>

    <div id="footer">
        <p>&copy; 2023 Admin Dashboard. All rights reserved.</p>
    </div>
</body>
</html>
