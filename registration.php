<?php
// submission process
if(isset($_POST['signup'])){
    // get data
    $name = $_POST['name'];
    $address = $_POST['address'];
    $mobile = $_POST['mobile'];
    $email = strtolower($_POST['email']);
    $password = $_POST['password'];
    $userselects = $_POST['userselects'];
    $table = ($userselects === "farmer") ? "farmer" : "counsellor";


    // Validations
    $errors = [];

    // Validate form inputs
    if (empty($name) || empty($email) || empty($address) || empty($mobile) || empty($password)) {
        $errors[] = "All fields are required";
    }
    // Password validation
    if (strlen($password) < 8 || strlen($password) > 16) {
        $errors[] = "Password must be between 8 and 16 characters.";
    }

    // Email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Name validation
    if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $errors[] = "Name should only contain letters and spaces.";
    }

    // Mobile number validation
    if (strlen($mobile) !== 10 || !is_numeric($mobile)) {
        $errors[] = "Mobile number should be 10 digits only.";
    }


    // Database connection
    $conn = new mysqli("localhost", "root", "", "agro_council");
    if ($conn->connect_error) {
        die("Connection Error" . $conn->connect_error);
    }

    // If there are no errors, proceed with inserting into the database
    if (empty($errors)) {
        // Prepare and execute the SQL query
        $sql = "INSERT INTO $table (name, address, mobile, email, password) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            $errors[] = "Error in database connection.";
        } else {
            // Sanitize user inputs
            $name = mysqli_real_escape_string($conn, $name);
            $address = mysqli_real_escape_string($conn, $address);
            $mobile = mysqli_real_escape_string($conn, $mobile);
            $email = mysqli_real_escape_string($conn, $email);
            $password = mysqli_real_escape_string($conn, $password);

            // Hashing password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Bind parameters and execute
            $stmt->bind_param("sssss", $name, $address, $mobile, $email, $hashedPassword);
            if ($stmt->execute()) {
                header("Location: login.php?success=1");
                exit;// Make sure to exit after redirection
            } else {
                $errors[] = "An error occurred while processing your request. Please try again later.";
            }
        }
    }

    // if ($conn->query($sql) === true) {
    //     header("Location: login.php");
    //     exit; 
    // } else {
    //     $errors[] = "Error: " . $conn->error;
    // }
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
