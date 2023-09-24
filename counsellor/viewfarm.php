<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Include files
include('../counsellor/layout/header.php');
include('../counsellor/layout/sidebar.php');

// Database connection
$conn = new mysqli("localhost", "root", "", "agro_council");
if ($conn->connect_error) {
    die("Connection Error: " . $conn->connect_error);
}

// Fetch farms
$sql = "SELECT * FROM farm ";
$result = $conn->query($sql);
?>
<!-- WHERE farmer_id = '" . $_SESSION['id'] . "' -->
<link rel="stylesheet" href="../css/table.css"> <!-- CSS link for table -->
<div class="con">
    <h1>Farm Details</h1>
    <div class="table-wrapper">
        <table class="fl-table">
            <tbody>
                <tr>
                    <th>SN</th>
                    <th>Farmer ID</th>
                    <th>Farm Area</th>
                    <th>Farm Unit</th>
                    <th>Farm Type</th>
                    <!-- <th>Action</th> -->
                </tr>
                <?php
                if ($result && $result->num_rows > 0) {
                    $i = 1;
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $row['farmer_id']; ?></td>
                            <td><?php echo $row['farm_area']; ?></td>
                            <td><?php echo $row['farm_unit']; ?></td>
                            <td><?php echo $row['farm_type']; ?></td>
                            <!-- <td>
                                <form method="post" action="myfarm_edit.php">
                                    <input type="hidden" value="<?php //echo $row['fid']; ?>" name="fid" />
                                    <input type="submit" value="Edit" name="edit" />
                                </form>
                                <form method="post" action="myfarm.php">
                                    <input type="hidden" value="<?php //echo $row['fid']; ?>" name="fid" />
                                    <input type="submit" value="Delete" name="delete" />
                                </form>
                            </td> -->
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="6">No farms found.</td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
