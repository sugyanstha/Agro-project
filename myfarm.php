<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Include files
include('layout/header.php');
include('layout/left.php');

// Database connection
$conn = new mysqli("localhost", "root", "", "agro_council");
if ($conn->connect_error) {
    die("Connection Error: " . $conn->connect_error);
}

// Delete record
if (isset($_POST['delete'])) {
    $id = $_POST['fid'];
    $sql = "DELETE FROM farm WHERE fid = '$id'";
    $result = $conn->query($sql);
    if ($result) {
        echo "<script>alert('Record Deleted Successfully');</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Add farm
if (isset($_POST['submit'])) {
    $farmer_id = $_POST['farmerid'];
    $farmarea = $_POST['farmarea'];
    $farmsize = $_POST['farmsize'];
    $farmtype = $_POST['farmtype'];

    $sql = "INSERT INTO farm (farm_area, farm_size, farm_type, farmer_id) VALUES ('$farmarea', '$farmsize', '$farmtype', '$farmer_id')";
    $result = $conn->query($sql);
    if ($result) {
        echo "<script>alert('Farm Inserted Successfully')</script>";
        header("Location: myfarm.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}

// Fetch farms
$sql = "SELECT * FROM farm WHERE farmer_id = '" . $_SESSION['id'] . "'";
$result = $conn->query($sql);
?>


<link rel="stylesheet" href="css/table.css"> <!--CSS link for table-->
<div class="con">
    <h1>Farm Details</h1>
    <div class="table-wrapper">
        <form action="" method="post">
            <input type="submit" value="Add" name="add">
        </form>
        <?php if (!isset($_POST['add'])) { ?>
            <table class="fl-table">
                <tbody>
                    <tr>
                        <th>SN</th>
                        <th>Farmer ID</th>
                        <th>Farm Area</th>
                        <th>Farm Size</th>
                        <th>Farm Type</th>
                        <th>Action</th>
                    </tr>
                    <?php if ($result && $result->num_rows > 0) {
                        $i = 1;
                        while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $row['farmer_id']; ?></td>
                                <td><?php echo $row['farm_area']; ?></td>
                                <td><?php echo $row['farm_size']; ?></td>
                                <td><?php echo $row['farm_type']; ?></td>
                                <td>
                                    <form method="post" action="myfarm_edit.php">
                                        <input type="hidden" value="<?php echo $row['fid']; ?>" name="fid" />
                                        <input type="submit" value="Edit" name="edit" />
                                    </form>
                                    <form method="post" action="myfarm.php">
                                        <input type="hidden" value="<?php echo $row['fid']; ?>" name="fid" />
                                        <input type="submit" value="Delete" name="delete" />
                                    </form>
                                </td>
                            </tr>
                        <?php }
                    } else { ?>
                        <tr>
                            <td colspan="6">No farms found.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>
    </div>
</div>

<link rel="stylesheet" href="css/myfarm.css"> <!--CSS link for form-->

<?php if (isset($_POST['add'])) { ?>
    <div class="cont">
        <div id="right">
            <form action="myfarm.php" method="post">
                <h1>Add Farm</h1>
                <div>
                    <label for="farmarea" class="far">Farm Area</label>
                    <input type="text" name="farmarea" /><br>
                    <label for="farmsize">Farm Size</label>
                    <select name="farmsize" id="farea">
                        <option value="acers">Acers</option>
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
            </form>
        </div>
    </div>
<?php } ?>

