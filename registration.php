
<?php
//submission process
if(isset($_POST['signup'])){
    //get data
    $name=$_POST['name'];
    $address=$_POST['address'];
    $mobile=$_POST['mobile'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $userselects=$_POST['userselects'];

        // Validations
        $errors = [];

        // Password validation
        if(strlen($password) < 8 || strlen($password) > 16){
            $errors[] = "Password must be between 8 and 16 characters.";
        }

        // Email validation
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors[] = "Invalid email format.";
        }

        // Name validation
        if(!preg_match("/^[a-zA-Z ]*$/", $name)){
            $errors[] = "Name should only contain letters and spaces.";
        }

        // Mobile number validation
        if(strlen($mobile) !== 10 || !is_numeric($mobile)){
            $errors[] = "Mobile number should be 10 digits only.";
        }
         //create connection

    $conn=new mysqli("localhost","root", "", "agro_council");
    if($conn->connect_error){
        die("Connection Error".$conn->connect_error);
    }
    else{
        echo"Connection Successfull";
    }

        // If there are no errors, proceed with inserting into the database
        if(empty($errors)){

            //inserting into database on selected options
            if($userselects=="farmer"){
            $sql="INSERT into farmer (name, address, mobile, email, password) Values
            ('$name', '$address', '$mobile', '$email', '$password') 
            ";
            // echo"farmer SQL query:".$sql;
            }
            elseif($userselects=="counsellor"){
                $sql="INSERT into counsellor (name, address, mobile, email, password) values 
                ('$name', '$address', '$mobile', '$email', '$password')
                ";
            }


            if($conn->query($sql)===true){
                header("Location:login.php");
            }
            else{
                echo"Error:".$conn->error;
            }
        }
        else{
            foreach($errors as $error){
                echo $error ."<br>";
            }
        }
    }


?>
   <div class="log">
  <div class="container">
      <h1>Registration Form</h1>
      <form method="post" action="registration.php">
        <link rel="stylesheet" href="css/login.css">
          <div class="form-group">
              <label for="name">Name:</label>
              <input type="text" id="name" name="name" placeholder="Enter your name" required>
          </div><div class="form-group">
              <label for="address">Address:</label>
              <input type="text" id="address" name="address" placeholder="Enter your address" required>
          </div><div class="form-group">
              <label for="mobile">Mobile:</label>
              <input type="number" id="mobile" name="mobile" placeholder="Enter your number" required>
          </div>
          <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" id="email" name="email" placeholder="Enter your email" required>
          </div>
          <div class="form-group">
              <label for="password">Password:</label>
              <input type="password" id="password" name="password" placeholder="Enter your password "required>
          </div>
          <div class="user-selects">
            <label for="farmer">Farmer</label>
            <input type="radio" name="userselects" id="farmer" value="farmer" checked>
            <label for="counsellor">Counsellor</label>
            <input type="radio" name="userselects" id="counsellor" value="counsellor">
          </div>
          <div class="form-group">
            <input type="submit" name="signup" value="SIGNUP">
            <p>Have a account? <a href="login.php">Click here!!!</a></p>
          </div>
  
      </form>
  
  </div>
  </div>


<?php
// include('layout/footer.php');
?>
