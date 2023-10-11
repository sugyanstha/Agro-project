<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Include Files
include('layout/header.php');
include('layout/left.php');

// Database Connection
$conn = new mysqli("localhost", "root", "", "agro_council");
if ($conn->connect_error) {
    die("Connection Error: " . $conn->connect_error);
}

// Delete record
if (isset($_POST['delete'])) {
    $id = $_POST['pid'];
    $sql = "DELETE FROM predicament WHERE pid = '$id'";
    $result = $conn->query($sql);
    if ($result) {
        echo "<script>alert('Record Deleted Successfully');</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Fetch Predicament
if (isset($_SESSION['id'])) { // Check if $_SESSION['id'] is set
    // $sql = "SELECT *, farmer.name as farmer_name FROM predicament INNER JOIN farmer ON predicament.farmer_id = farmer.id WHERE farmer_id = '" . $_SESSION['id'] . "'";
    $sql = "SELECT * FROM predicament WHERE farmer_id = '" . $_SESSION['id'] . "'";
    $result = $conn->query($sql);
}
?>

<link rel="stylesheet" href="css/table.css">
<div class="con">
    <h1>Predicament Details</h1>
    <div class="table-wrapper">

        <table class="fl-table">
            <tbody>
                <tr>
                    <th width=10%>SN</th>
                    <th width=25%>Title</th>
                    <th width=45%>Description</th>
                    <th width=10%>Submitted Date</th>
                    <th width=15%>Action</th>
                </tr>
                <?php if (isset($result) && $result->num_rows > 0) { // Check if $result is set
                    $i = 1;
                    while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $row['title']; ?></td>
                            <td><?php echo $row['description']; ?></td>
                            <td><?php echo $row['submitted_date']; ?></td>

                            <td>
                                <form method="post" action="edit_predicament.php">
                                    <input type="hidden" value="<?php echo $row['pid']; ?>" name="pid" />
                                    <input type="submit"  value="Update" name="edit_predicament" />
                                </form>

                                <form method="post" action="predicament_table.php">
                                    <input type="hidden" value="<?php echo $row['pid']; ?>" name="pid" />
                                    <input type="submit" value="Delete" name="delete" />
                                </form>
                            </td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr>
                        <td colspan="6">No Predicament found.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
