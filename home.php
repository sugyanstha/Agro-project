<?php
include('layout/header.php');

// Check if the user is logged in; redirect to login page if not logged in
session_start();
if(!isset($_SESSION['email']))
{
   header("location:login.php");
}
$email=$_SESSION['email'];

// Set the active page based on the user's login status
// $activePage = $email ? "myfarm.php" : "default"; // Set "myfarm.php" as active if logged in, else set "default"

include('layout/left.php');
?>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$conn = new mysqli("localhost", "root", "", "agro_council");
if ($conn->connect_error) {
    die("Connection Error: " . $conn->connect_error);
}

// Delete record if the delete form is submitted
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



// Fetch farms for the logged-in user
$sql = "SELECT * FROM farm WHERE farmer_id = '" . $_SESSION['id'] . "'";
$result = $conn->query($sql);
?>


<link rel="stylesheet" href="css/table.css"> <!--CSS link for table-->
<div class="con">
    
        
    <?php if (!isset($_POST['add'])) { ?>
        <h1>Farm Details</h1>
        <div class="table-wrapper">
            <form action="farmform.php" method="post">
                <input type="submit" value="Add Farm" name="add">
            </form>
            <table class="fl-table">
                <tbody>
                    <tr>
                        <th>SN</th>
                        <th>Farmer ID</th>
                        <th>Farm Area</th>
                        <th>Farm Unit</th>
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
                                <td><?php echo $row['farm_unit']; ?></td>
                                <td><?php echo $row['farm_type']; ?></td>
                                <td>
                                    <div class="button-row">
                                        <form method="post" action="myfarm_edit.php">
                                            <input type="hidden" value="<?php echo $row['fid']; ?>" name="fid" />
                                            <input type="submit" value="Edit" name="edit" />
                                        </form>
                                        <form method="post" action="home.php">
                                            <input type="hidden" value="<?php echo $row['fid']; ?>" name="fid" />
                                            <input type="submit" value="Delete" name="delete" />
                                        </form>
                                    </div>
                                    <form action="add_predicament.php" method="post">
                                        <input type="submit" value="Add Predicament" name="add">
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



