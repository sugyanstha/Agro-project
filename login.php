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
    $email=$_POST['email'];
    $password=$_POST['password'];
    $userselects=$_POST['userselects'];
    $errors=array();
    if(empty($email) || empty($password)){
        $errors[]="Email or Password empty";
    }

    if(count($errors)>0){
        foreach($errors as $errmsg){
            echo"<script>alert('$errmsg');</script>";
        }
        echo"<script>window.location.href='home.php';</script>";
        exit;
    }
    else{

    $conn=new mysqli("localhost", "root", "", "agro_council");
    if($conn->connect_error){
        die("Connection Error");
    }

    //check userselect
    if($userselects=="farmer")
    $sql="SELECT * from farmer WHERE email='$email' and password='$password'";

    if($userselects=="counsellor")
    $sql="SELECT * from counsellor WHERE email='$email' and password='$password'";

    $result=$conn->query($sql);

    if ($result->num_rows>0) {

        //fetch the row and store id and email
        $row =$result->fetch_assoc();
        $id=$row['id'];
        $email=$row['email'];
        $usertypes=$userselects;
        
        //store the id and email in session variables
        $_SESSION['id'] = $id;
        $_SESSION['email'] = $email;
        $_SESSION['usertype'] = $userselects;

        //redirect the user to the home page
        header("location:home.php");
        exit;
    }
    else{
        echo"<script>alter('Email or Password Invalid');</script>";
        echo"<script>window.location.href='login.php';</script>";
        exit;
        }
    }

}

?>
        
        <link rel="stylesheet" href="css/login.css">

<div class="log">
  <div class="container">
      <h1>Login</h1>
      <form method="post" action="login.php" autocomplete="off">
          <div class="form-group">
              <label for="email">Email:</label>
              <input type="text" id="email" name="email" placeholder="Enter your email" required>
          </div>
          <div class="form-group">
              <label for="password">Password:</label>
              <input type="password" id="password" name="password" placeholder="Enter your password "required>
          </div>
            <div>
            <p >Forget Password? <a href="#">Click Here!</a></p>

            </div>
          <div class="user-selects">
            <div class="farmer-part">  
                <label for="farmer">Farmer</label>
                <input type="radio" name="userselects" id="farmer" value="farmer" checked>
            </div>
            <div class="farmer-part">
                <label for="counsellor">Counsellor</label>
                <input type="radio" name="userselects" id="counsellor" value="counsellor">
            </div>

          </div>
          <div class="button-group">
            <input type="submit" name="login" value="LOGIN">
          </div>
            <div>
            <p>Don't have a account? <a href="registration.php">Register Here!!!</a> </p>

            </div>
        </form>
  </div>
  </div>


