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
    $id=$_POST['gid'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $sql="UPDATE guidelines SET title='$title', description='$description'";
    $result=$conn->query($sql);
    if($result){
        echo '<script>alert("Updated Successfully");</script>';
        echo '<script>window.location.href="guidelines_table.php"</script>';        
    }
    else{
        echo"Error";
    }
}

// Edit farm
if (isset($_POST['edit_guidelines'])) {
    $id = $conn->real_escape_string($_POST['gid']);
    $sql = "SELECT title, description FROM guidelines WHERE gid='$id'";
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
<link rel="stylesheet" href="../css/perdicament_form.css">

<div class="container">
    <div id="right">
        <h1>Add Guidelines</h1>
        <form action="edit_guidelines.php" method="post">
            <div class="pre">
                <label for="guidelines">Guidelines title</label>
                <input type="text" value="<?php echo $title;?>" name="title" id="title" /><br>
            </div>
            <div class="textbox">
                <label for="description">Description</label>
                <textarea name="description" id="description" placeholder="Enter Guidelines" cols="30" rows="10"><?php echo $description;?></textarea>
            </div>
            <input type="hidden" value="<?php echo $id; ?>" name="gid">
            <input type="submit" value="Update" name="update"/>

            <!-- <input type="submit" value="Add Guidelines" name="add"/><br> -->
            <a href="guidelines_table.php">Back</a>
        </form>
    </div>
</div>