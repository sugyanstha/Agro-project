<?php
// Include Files
include('layout/header.php');
// include('layout/left.php');

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

    $sql = "INSERT INTO predicament (title, description, farmer_id) VALUES ('$title', '$description', '$farmer_id')";
    $result = $conn->query($sql);
    if ($result) {
        echo "<script>alert('Predicament Inserted Successfully')</script>";
        header("Location: predicament_table.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>


<link rel="stylesheet" href="css/perdicament_form.css">

<div class="container">
    <div id="right">
        <h1>Add Predicament</h1>
        <form action="add_predicament.php" method="post">
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
