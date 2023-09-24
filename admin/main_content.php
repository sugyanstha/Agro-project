
<link rel="stylesheet" href="../css/adminMain.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="../css/sweetAlert.css">
<?php
//Database Connection
$conn=new mysqli("localhost","root", "", "agro_council");
    if($conn->connect_error){
        die("Connection Error".$conn->connect_error);
    }
  
    // include '../admin/admindahboard.php';
  
// Check if a button is selected and assign a class to highlight it
$farmerSelected = isset($_POST['farmer']) ? 'selected' : '';
$counsellorSelected = isset($_POST['counsellor']) ? 'selected' : '';
$guidelinesSelected = isset($_POST['guidelines']) ? 'selected' : '';

// Retrieve the selected button from the URL parameter
$selectedButton = isset($_GET['selected']) ? $_GET['selected'] : '';

// Determine which button was selected and set the corresponding class
if ($selectedButton === 'farmer') {
    $farmerSelected = 'selected';
    $table = 'farmer'; // Set the appropriate table based on the selected button
} elseif ($selectedButton === 'counsellor') {
    $counsellorSelected = 'selected';
    $table = 'counsellor'; // Set the appropriate table based on the selected button
} elseif ($selectedButton === 'guidelines') {
    $guidelinesSelected = 'selected';
    $table = 'guidelines'; // Set the appropriate table based on the selected button
} else {
    $farmerSelected = 'selected';
    $table = 'farmer';//error
}


$deleteTable = ''; // Initialize the deleteTable variable

// Check if the delete form is submitted
// Check if the delete form is submitted
if (isset($_POST['action']) && $_POST['action'] === 'delete' && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Retrieve the deleteTable value
    $deleteTable = $_POST['deleteTable'];

    // Construct the SQL DELETE query using the correct table name
      if (!empty($deleteTable)) {
        if ($deleteTable === 'farmer') {
            $sql = "DELETE FROM `$deleteTable` WHERE id = $id";
        } elseif ($deleteTable === 'guidelines') {
            $sql = "DELETE FROM `$deleteTable` WHERE gid = $id";
        }

        $result = mysqli_query($conn, $sql);
    
}
}


?>
<div class="admin-main">
    <div class="head-table">
    <form action="?selected=farmer" method="POST">
        <button type="submit" name="farmer" class="<?php echo $farmerSelected; ?>">Farmer</button>
    </form>
    <form action="?selected=counsellor" method="POST">
        <button type="submit" name="counsellor" class="<?php echo $counsellorSelected; ?>">Counsellor</button>
    </form>
    <form action="?selected=guidelines" method="POST">
        <button type="submit" name="guidelines" class="<?php echo $guidelinesSelected; ?>">Guidelines</button>
    </form>
    </div>

    <div class="table-container">
        <table>
        <link rel="stylesheet" href="../admin/css/table.css">

            <?php
                $sql = "SELECT * FROM `$table`";
                $result = mysqli_query($conn, $sql);
                
                if ($result && mysqli_num_rows($result) > 0) {
                    $columns = array_keys(mysqli_fetch_assoc($result));
                    mysqli_data_seek($result, 0);

                    $excludedColumns = ['password', 'img_srcs', 'id', 'reset_otp_hash', 'reset_otp_expires_at'];

                    echo "<tr><th>SN</th>";
                    foreach ($columns as $column) {
                        if (!in_array($column, $excludedColumns)) {
                            echo "<th>" . strtoupper($column) . "</th>";
                        }
                    }        
                    echo "<th>ACTION</th>";
                    echo "</tr>";

                    $i = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr><td>$i</td>";
                        foreach ($row as $column => $value) {
                            if (!in_array($column, $excludedColumns)) {
                                echo "<td>$value</td>";
                            }
                            if ($column === 'id' || $column === 'gid') {
                                $id = $value;
                            }
                        }
                        echo "<td class='td-center'>
                        <form action='' method='post' class='deleteBtn' onsubmit=\"confirmDelete(event)\">
                            <input type='hidden' name='action' value='delete'>
                            <input type='hidden' name='id' value='" . $id . "'> <!-- Sending id -->
                            <input type='hidden' name='deleteTable' value='" . $table . "'> <!-- Sending table selected -->
                            <button type='submit'>Delete</button>
                        </form>
                        </td>";
                    
                        echo "</tr>";
                        $i++;
                    }
                } else {
                    echo "<td>No data to display.</td>";
                }
            ?>
        </table>
    </div>
</div>
<script src="../js/confirmationSA.js"></script>