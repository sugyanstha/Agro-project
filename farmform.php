<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

//Include File
include('layout/header.php');
// include('layout/left.php');

//Database Connection
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

    $sql = "INSERT INTO farm (farm_area, farm_unit, farm_type, farmer_id) VALUES ('$farmarea', '$farmunit', '$farmtype', '$farmer_id')";
    $result = $conn->query($sql);
    if ($result) {
        echo "<script>alert('Farm Inserted Successfully')</script>";
        header("Location: home.php");
        exit;
    } else {
        echo "Error: " . $conn->error; // Display database error
    }
}?>


<link rel="stylesheet" href="css/myfarm.css"> <!--CSS link for form-->

<?php if (isset($_POST['add'])) { ?>
    <div class="cont">
        <div id="right">
            <form action="" method="post">
                <h1>Add Farm</h1>
                <div>
                    <label for="farmarea" class="far">Farm Area</label>
                    <input type="text" name="farmarea" /><br>
                    <label for="farmunit">Farm Unit</label>
                    <select name="farmunit" id="farea">
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
<?php } ?>