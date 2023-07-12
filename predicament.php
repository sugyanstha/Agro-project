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

// Add Predicament
if (isset($_POST['submit'])) {
    $farmer_id = $_POST['farmerid'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    $sql = "INSERT INTO predicament (farmer_id, title, description) VALUES ('$farmer_id', '$title', '$description')";
    $result = $conn->query($sql);
    if ($result) {
        echo "<script>alert('Predicament Inserted Successfully')</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Fetch Predicament
$sql = "SELECT * FROM predicament WHERE farmer_id = '" . $_SESSION['id'] . "'";
$result = $conn->query($sql);
?>


<link rel="stylesheet" href="css/table.css">
<div class="con">
    <h1>Predicament Details</h1>
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
                        <th>Title</th>
                        <th>Description</th>
                        <!-- <th>Submitted Date</th> -->
                        <th>Action</th>
                    </tr>
                    <?php if ($result && $result->num_rows > 0) {
                        $i = 1;
                        while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $row['farmer_id']; ?></td>
                                <td><?php echo $row['title']; ?></td>
                                <td><?php echo $row['description']; ?></td>
                                <!-- <td><?php echo $row['submitted_date']; ?></td> -->
                                <td>
                                    <!-- <form method="post" action="myfarm_edit.php">
                                        <input type="hidden" value=" name="fid" />
                                        <input type="submit" value="Edit" name="edit" />
                                    </form> -->
                                    <form method="post" action="predicament.php">
                                        <input type="hidden" value="<?php echo $row['pid']; ?>" name="fid" />
                                        <input type="submit" value="Delete" name="delete" />
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
        <?php } ?>
    </div>
</div>

<link rel="stylesheet" href="css/predicament.css">

<div class="container">
    <div id="right">
        <h1>Add Predicament</h1>
        <form action="predicament.php" method="post">
            <div class="pre">
                <label for="predicament">Predicament title</label>
                <input type="text" name="title" /><br>
            </div>
            <div class="textbox">
                <label for="description">Description</label>
                <textarea name="description" id="description" placeholder="Enter your predicament description" cols="30" rows="10"></textarea>
            </div>
            <input type="hidden" value="<?php echo $_SESSION['id']; ?>" name="farmerid">
            <input type="submit" value="Add Predicament" name="submit" />
        </form>
    </div>
</div>
