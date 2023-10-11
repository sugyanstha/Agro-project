<?php
// include('layout/header.php');
//include('layout/left.php');
?>

<?php
session_start();
//check if the user is already logged in
if(isset($_SESSION['email'])){
    header("location: home.php");
    exit;
}

if(isset($_POST['login'])){
    //get user username or password from form
    $email=strtolower($_POST['email']);
    $password=$_POST['password'];
    $userselects=$_POST['userselects'];

    //Database Connection
    $conn=new mysqli("localhost", "root", "", "agro_council");
    if($conn->connect_error){
        die("Connection Error: " . $conn->connect_error);
    }

    // Use prepared statements to prevent SQL injection
    $sql = "";
    if ($userselects == "farmer") {
        $sql = "SELECT * FROM farmer WHERE email = ?";
    } elseif ($userselects == "counsellor") {
        $sql = "SELECT * FROM counsellor WHERE email = ?";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    // $stmt->store_result();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];
    
        if (password_verify($password, $hashedPassword)) {
            // Password matches, store user details in session
            $_SESSION['id'] = $row['id'];
            $_SESSION['email'] = $email;
            $_SESSION['usertype'] = $userselects;
    
            if ($userselects == "farmer") {
                header("location: home.php");
            } elseif ($userselects == "counsellor") {
                header("location: counsellor/view_predicament.php");
            }
            exit;
        
        } else {
            header("Location: login.php?error=1");
            exit;
        }
    } else {
        header("Location: login.php?error=1");
        exit;
    }
    
}
?>
<link rel="stylesheet" href="css/login.css">

<div class="log">
    <div class="container">
        <h1>Agrocouncil Login</h1>
        <?php if (isset($_GET['error'])) { ?>
        <div class="error-message">
            Username or Password Invalid!
        </div>
        <?php } ?>
        <form method="post" action="login.php" autocomplete="off">
            <div class="group-login">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="group-login">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter your password "required>
            </div>
            <div class="user-selects">
                <div class="farmer-part">  
                    <input type="radio" name="userselects" id="farmer" value="farmer" checked>
                    <label for="farmer">Farmer</label>
                </div>
                <div class="counsellor-part">
                    <input type="radio" name="userselects" id="counsellor" value="counsellor">
                    <label for="counsellor">Counsellor</label>
                </div> 
            </div>

            <span>Forgot Password? <a href="forgetpassword/forgetpwd.php">Click Here!</a></span>
            <div class="button-group">
                <button type="submit" name="login" value="login">LOGIN</button>
            </div>
            <span>Don't have an account? <a href="registration.php">Register Here!!!</a></span>
        </form>
    </div>
</div>


