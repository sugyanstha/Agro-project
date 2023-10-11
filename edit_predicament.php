<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include files
include('layout/header.php');
// include('layout/left.php');

// Database connection
$conn = new mysqli("localhost", "root", "", "agro_council");
if ($conn->connect_error) {
    die("Connection Error: " . $conn->connect_error);
}



// View guidelines details
if (isset($_POST['update'])) {
    $id=$_POST['pid'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $sql="UPDATE predicament SET title='$title', description='$description' WHERE pid = '$id'";
    $result=$conn->query($sql);
    if($result){
        echo '<script>alert("Updated Successfully");</script>';
        echo '<script>window.location.href="predicament_table.php"</script>';        
    }
    else{
        echo"Error";
    }
}

// Edit farm
if (isset($_POST['edit_predicament'])) {
    $id = $conn->real_escape_string($_POST['pid']);
    $sql = "SELECT title, description FROM predicament WHERE pid='$id'";
    $result = $conn->query($sql);

    if ($result) {
        $row = $result->fetch_assoc();
        $title = $row['title'];
        $description = $row['description'];
    } else {
        die("Error: " . $conn->error);
    }
}
?>

<!-- Guidelines Form -->
<link rel="stylesheet" href="css/perdicament_form.css">

<div class="container">
    <div id="right">
        <h1>Add Predicament</h1>
        <form action="edit_predicament.php" method="post">
            <div class="pre">
                <label for="predicament">Predicament title</label>
                <input type="text" value="<?php echo $title;?>" name="title" id="title" required/><br>
            </div>
            <div class="textbox">
                <label for="description">Description</label>
                <textarea name="description" id="description" placeholder="Enter Guidelines" cols="30" rows="10" required><?php echo $description;?></textarea>
            </div>
            <input type="hidden" value="<?php echo $id; ?>" name="pid">
            <input type="submit" value="Update" name="update"/>

            <!-- <input type="submit" value="Add Guidelines" name="add"/><br> -->
            <a href="predicament_table.php">Back</a>
        </form>
    </div>
</div>