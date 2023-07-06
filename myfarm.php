<?php
include('layout/header.php');
include('layout/left.php');
?>

<?php
session_start();

if (isset($_POST['submit'])) {
    $farmer_id = $_POST['farmerid'];
    $farmarea = $_POST['farmarea'];
    $farmtype = $_POST['farmtype'];
    $conn = new mysqli("localhost", "root", "", "agro_council");
    if ($conn->connect_error) {
        die("Connection Error");
    }
    $sql = "INSERT INTO farm (farm_area, farm_type, farmer_id) VALUES ('$farmarea', '$farmtype', '$farmer_id')";
    $result = $conn->query($sql);
    if ($result) {
        echo "Farm Inserted Successfully";
    } else {
        echo "Error";
    }
}

$conn = new mysqli("localhost", "root", "", "agro_council");
if ($conn->connect_error) {
    die("Connection Error");
}
$sql = "SELECT * FROM farm WHERE farmer_id = '" . $_SESSION['id'] . "'";
$result = $conn->query($sql);
?>

<h1>Your Farm</h1>
<form action="" method="post">
    <input type="submit" value="Add" name="add">
</form>
<?php
if(!isset($_POST['add']))
{
?>
<table align="center" border="1" style="width:50%">
    <tr>
        <th>Farm Area</th>
        <th>Farm Type</th>
    </tr>
    <?php
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['farm_area'] . "</td>";
            echo "<td>" . $row['farm_type'] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='2'>No farms found.</td></tr>";
    }
    $conn->close();
    ?>
</table>


<link rel="stylesheet" href="css/farm.css">
<?php
}
if (isset($_POST['add'])) {
    echo '
    <div class="container">
        <div id="right">
            <form action="myfarm.php" method="post">
                <h1>Add Your Farm</h1>
                <div>
                    <label for="farmarea">Farm Area</label>
                    <input type="text" name="farmarea" /><br>
                </div>
                <div>
                    <label for="farmtype">Farm Type</label>
                    <input type="text" name="farmtype" /><br>
                </div>
                <input type="hidden" value="' . $_SESSION['id'] . '" name="farmerid">
                <input type="submit" value="Add Farm" name="submit" />
            </form>
        </div>
    </div>';
}
?>


<?php
// include('layout/footer.php');
?>
