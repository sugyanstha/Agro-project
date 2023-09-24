<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include files
include('layout/header.php');
// include('layout/left.php');

// Database connection
$conn = new mysqli("localhost", "root", "", "agro_council");
if ($conn->connect_error) {
    die("Connection Error: " . $conn->connect_error);
}

// Edit farm
if (isset($_POST['edit_farm'])) {
    $farmarea = $_POST['farmarea'];
    $farmunit = $_POST['farmunit'];
    $farmtype = $_POST['farmtype'];
    $id = $_POST['fid'];
    $sql = "UPDATE farm SET farm_area='$farmarea', farm_unit='$farmunit', farm_type='$farmtype' WHERE fid='$id'";
    $result = $conn->query($sql);
    if ($result) {
        header("Location: home.php");
        exit;
    } else {
        die("Error: " . $conn->error);
    }
}

// View farm details
if (isset($_POST['edit'])) {
    $id = $_POST['fid'];
    $sql = "SELECT * FROM farm WHERE fid='$id'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $farmarea = $row['farm_area'];
        $farmunit = $row['farm_unit'];
        $farmtype = $row['farm_type'];
    } else {
        die("No farm found with the given ID.");
    }
}
?>

<link rel="stylesheet" href="css/myfarm.css">

<body>
    <div class="cont">
        <div id="right">
            <form action="myfarm_edit.php" method="post">
                <h1>Edit Farm</h1>
                <div>
                    <label for="farmarea" class="far">Farm Area</label>
                    <input type="text" name="farmarea" value="<?php echo $farmarea; ?>" /><br>
                    <label for="framunit">Farm Unit</label>
                    <select name="farmunit" id="farea">
                        <option value="acers">Acers</option>
                        <option value="biga">Biga</option>
                        <option value="aana">Aana</option>
                        <option value="ropani">Ropani</option>
                    </select>
                </div>
                <div>
                    <label for="farmtype">Farm Type</label>
                    <input type="text" name="farmtype" value="<?php echo $farmtype; ?>" /><br>
                </div>
                <input type="hidden" value="<?php echo $id; ?>" name="fid">
                <input type="submit" value="Update" name="edit_farm" />

                <a href="home.php">Back</a>

            </form>
        </div>
    </div>
</body>
</html>
