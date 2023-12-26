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

// Fetch Guidelines based on Counsellor ID stored in the session
if (isset($_SESSION['id'])) { // Check if $_SESSION['id'] is set
    $sql = "SELECT * FROM guidelines WHERE counsellor_id = '" . $_SESSION['id'] . "'";
    $result = $conn->query($sql);
}
?>

<link rel="stylesheet" href="css/table.css">
<div class="con">
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
                    <!-- <th>Action</th> -->
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

                            <td>
                                <!-- <form method="post" action="guidelines_table.php">
                                    <input type="hidden" value="<?php //echo $row['id']; ?>" name="id" />
                                    <input type="submit" value="Delete" name="delete" />
                                </form> -->
                            </td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr>
                        <td colspan="6">No Guidelines found.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

