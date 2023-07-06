<?php
   
    if(isset($_POST['login'])){
        $adminname=$_POST['adminname'];
        $adminpassword=$_POST['adminpassword'];

        $conn=new mysqli("localhost", "root", "", "agro_council");
        if($conn->connect_error){
            die("Connection Error");
        }
        $sql="SELECT * FROM admin WHERE adminname='$adminname' and adminpassword='$adminpassword'";
        $result=$conn->query($sql);
        if($result->num_rows>0){
            header("Location: admindashboard.php"); 
            $_SESSION['adminname'] = $_POST['adminname'];
        }
        else{
            echo"<script>alert('Incorrect Password');</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link rel="stylesheet" href="../css/adminlogin.css">
<body>
    <div class="container">
    <div class="login-form">
    <h2>ADMIN LOGIN PANEL</h2>
    <form action="" method="post">
        <div class="input-field">
            <input type="text" placeholder="Admin Name" name="adminname">
        </div>
        <div class="input-field">
            <input type="password" placeholder="Password" name="adminpassword">
        </div>
        <button type="submit" name="login">Log in</button>

    </form>
    </div>
    </div>
</body>
</html>