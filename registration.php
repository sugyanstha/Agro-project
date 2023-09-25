<?php

    // Database connection
    $conn = new mysqli("localhost", "root", "", "agro_council");
    if ($conn->connect_error) {
        die("Connection Error" . $conn->connect_error);
    }

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

    // Uniqye Key Validation 
    $sql_check_mail = "SELECT * FROM $table WHERE email = '$email'";
    $result_check_mail = $conn->query($sql_check_mail);
    if ($result_check_mail->num_rows > 0){
        $errors[] = "Email Already Registered";
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

    

   // Display errors using SweetAlert
    if (!empty($errors)) {
        $errorMessages = join("\n", $errors);
        echo '.<script>
        document.addEventListener("DOMContentLoaded", function() {
        Swal.fire({
            icon: "error",
            title: "Sign Up Errors",
            html: "' . $errorMessages . '",
            showCloseButton: true,
        });
    });

        </script>';
    }
}
?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="css/sweetAlert.css">
<div class="logg">
    <div class="container">
        <h1>Registration Form</h1>
            <form method="post" action="registration.php" autocomplete="off">
        <link rel="stylesheet" href="css/login.css">
            <div class="group-loginn">
                <label for="name" class="labell">Name:</label>
                <input type="text" id="name" name="name" placeholder="Enter your name" required>
            </div>
            <div class="group-loginn">
                <label for="address" class="labell">Address:</label>
                <input type="text" id="address" name="address" placeholder="Enter your address" required>
            </div>
            <div class="group-loginn">
                <label for="mobile" class="labell">Mobile:</label>
                <input type="tel" id="mobile" name="mobile" placeholder="Enter your number" required>
            </div>
            <div class="group-loginn">
                <label for="email" class="labell">Email:</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="group-loginn">
                <label for="password" class="labell">Password:</label>
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
            <div class="button-group">
                <button type="submit" name="signup" value="signup">SIGNUP</button>
            </div>
            <span>Have a account? <a href="login.php">Click here!!!</a></span>
            </form>
    </div>
</div>


<?php
// include('layout/footer.php');
?>
