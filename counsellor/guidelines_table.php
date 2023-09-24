<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Include Files
include('../counsellor/layout/header.php');
include('../counsellor/layout/sidebar.php');
// include('layout/left.php');

// Database Connection
$conn = new mysqli("localhost", "root", "", "agro_council");
if ($conn->connect_error) {
    die("Connection Error: " . $conn->connect_error);
}

// Delete record
if (isset($_POST['delete'])) {
    $id = $_POST['gid'];
    $sql = "DELETE FROM guidelines WHERE gid = '$id'";
    $result = $conn->query($sql);
    if ($result) {
        echo "<script>alert('Record Deleted Successfully');</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Fetch Guidelines
if (isset($_SESSION['id'])) { // Check if $_SESSION['id'] is set
    $sql = "SELECT * FROM farmer
    INNER JOIN predicament ON farmer.id = predicament.farmer_id
    INNER JOIN guidelines ON predicament.pid = guidelines.predicament_id
    WHERE counsellor_id = '" . $_SESSION['id'] . "'";

    $result = $conn->query($sql);
}
?>

<link rel="stylesheet" href="../css/table.css">
<div class="con">
<?php if (!isset($_POST['edit_guidelines'])) { ?>

    <h1 align="center">Guidelines Details</h1>
    <div class="table-wrapper">
        <!-- <form action="add_guidelines.php" method="post">
            <input type="submit" value="Add" name="add">
        </form> -->
        <table class="fl-table">
            <tbody>
                <tr>
                    <th>SN</th>
                    <th>Counsellor ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Submitted Date</th>
                    <th>Predicament ID</th>
                    <th>Farmer ID</th>
                    <th>Action</th>
                </tr>
                <?php if (isset($result) && $result->num_rows > 0) { // Check if $result is set
                    $i = 1;
                    while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $row['counsellor_id']; ?></td>
                            <td><?php echo $row['title']; ?></td>
                            <td><?php echo $row['description']; ?></td>
                            <td><?php echo $row['submitted_date']; ?></td>
                            <td><?php echo $row['predicament_id']; ?></td>
                            <td><?php echo $row['farmer_id']; ?></td>

                            <td>
                                <form method="post" action="edit_guidelines.php">
                                    <input type="hidden" value="<?php echo $row['gid']; ?>" name="gid" />
                                    <input type="submit"  value="Update" name="edit_guidelines" />
                                </form>

                                <form method="post" action="guidelines_table.php">
                                    <input type="hidden" value="<?php echo $row['gid']; ?>" name="gid" />
                                    <input type="submit" value="Delete" name="delete" />
                                </form>
                            </td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr>
                        <td colspan="7">No Guidelines found.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php } ?>
    </div>
</div>

