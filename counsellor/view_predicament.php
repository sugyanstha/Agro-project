<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Include Files
include('dashboard.php');
// include('layout/left.php');

// Database Connection
$conn = new mysqli("localhost", "root", "", "agro_council");
if ($conn->connect_error) {
    die("Connection Error: " . $conn->connect_error);
}

//Add Guidelines
if(isset($_POST['submit'])){
    $pid = $_POST['pid'];

    // Add Guidelines
    if (isset($_POST['add'])) {
        $counsellor_id = $_POST['counsellorid'];
        $title = $_POST['title'];
        $description = $_POST['description'];

        // Sanitize inputs
        $title = $conn->real_escape_string($title);
        $description = $conn->real_escape_string($description);

        $sql = "INSERT INTO guidelines (counsellor_id, title, predicament_id, description) VALUES ('$counsellor_id', '$title', '$pid', '$description')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Guidelines Inserted Successfully')</script>";
            header("Location: view_predicament.php");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}


// Fetch Predicament
if (isset($_SESSION['id'])) { // Check if $_SESSION['id'] is set
    $sql = "SELECT * FROM predicament WHERE farmer_id = '" . $_SESSION['id'] . "'";
    $result = $conn->query($sql);
}
?>

<link rel="stylesheet" href="../css/table.css">
<div class="con">
    <h1>Predicament Details</h1>
    <div class="table-wrapper">
        <!-- <form action="add_guidelines.php" method="post">
            <input type="submit" value="Add Guidelines" name="add">
        </form> -->
        <table class="fl-table">
            <tbody>
                <tr>
                    <th>SN</th>
                    <th>Farmer ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <!-- <th>Submitted Date</th> -->
                    <th>Action</th>
                </tr>
                <?php if (isset($result) && $result->num_rows > 0) { // Check if $result is set
                    $i = 1;
                    while ($row = $result->fetch_assoc()) { 
                        ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $row['farmer_id']; ?></td>
                            <td><?php echo $row['title']; ?></td>
                            <td><?php echo $row['description']; ?></td>
                            <!-- <td><?php //echo $row['submitted_date']; ?></td> -->
                            <td>
                            <form method="post" action="../counsellor/add_guidelines.php">
                                <input type="hidden" value="<?php echo $row['pid']; ?>" name="pid" />
                                <input type="submit" value="Update" name="edit_guidelines" />
                            </form>

                            <form method="post" action="add_guidelines.php">
                                <input type="hidden" value="<?php echo $row['pid']; ?>" name="pid" />
                                <input type="submit" value="Add Guidelines" name="add_guidelines" />
                            </form>

                            </td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr>
                        <td colspan="5">No Predicament found.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

