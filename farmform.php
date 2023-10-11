<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="css/sweetAlert.css">
    <link rel="stylesheet" href="css/myfarm.css"> <!--CSS link for form-->
    <title>Add Form</title>
</head>
<body>


<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Include File
include('layout/header.php');
// include('layout/left.php');

// Database Connection
$conn = new mysqli("localhost", "root", "", "agro_council");
if ($conn->connect_error) {
    die("Connection Error: " . $conn->connect_error);
}

// Add farm
if (isset($_POST['submit'])) {
    $farmer_id = $_POST['farmerid'];
    $farmarea = $_POST['farmarea'];
    $farmunit = $_POST['farmunit'];
    $farmtype = $_POST['farmtype'];

    $errors = [];

    if (empty($farmarea) || empty($farmunit) || empty($farmtype)) {
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'All fields are required!',
                showConfirmButton: true,
                confirmButtonText: 'OK',
            });
        </script>
        <?php
    } else {
        $sql = "INSERT INTO farm (farm_area, farm_unit, farm_type, farmer_id) VALUES ('$farmarea', '$farmunit', '$farmtype', '$farmer_id')";
        $result = $conn->query($sql);
        if ($result) {
            ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Successful',
                    text: 'Farm Added!',
                    showConfirmButton: true,
                    confirmButtonText: 'OK',
                }).then(function(){
                    window.location.href = "home.php";
                });
            </script>

            <?php

        } else {
            // echo "Error: " . $conn->error; // Display database error
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Error: <?php echo $conn->error; ?>',
                    });
                  </script>";
        }
        }
    }

?>



    <div class="cont">
        <div id="right">
            <form action="" method="post">
                <h1>Add Farm</h1>
                <div>
                    <label for="farmarea" class="far">Farm Area</label>
                    <input type="text" name="farmarea" /><br>
                    <label for="farmunit">Farm Unit</label>
                    <select name="farmunit" id="farea" >
                        <option value="acre">Acre</option>
                        <option value="biga">Biga</option>
                        <option value="aana">Aana</option>
                        <option value="ropani">Ropani</option>
                    </select>
                </div>
                <div>
                    <label for="farmtype">Farm Type</label>
                    <input type="text" name="farmtype" /><br>
                </div>
                <input type="hidden" value="<?php echo $_SESSION['id']; ?>" name="farmerid">
                <input type="submit" value="Add Farm" name="submit" />
                <a href="home.php">Back</a>
            </form>
        </div>
    </div>
    
</body>
</html>