<?php
include('layout/header.php');
include('layout/left.php');


?>


<?php
session_start();

$_SESSION['id'];

if(isset($_POST['submit'])){
    $id=$_POST['farmerid'];
    $title=$_POST['title'];
    $description=$_POST['description'];
$conn=new mysqli("localhost","root","","agro_council");
if($conn->connect_error){
    die("Connection Error");
}
$sql="INSERT into predicament (farmer_id, title, description) values('$id','$title', '$description')";
$result=$conn->query($sql);
if($result){
    echo"Perdicamnet Inserted Successfully";
}
else{
    echo"Error";
}
}
?>

<link rel="stylesheet" href="css/perdicament.css">
<div class="container">
    <div id="right">
        <h1>Add Predicament</h1>
        <form action="predicament.php" method="post">
            <div class="pre">
                <label for="predicament">Predicament title</label>
                <input type="text" name="title"/><br>
            </div>
            <div class="textbox">
                <label for="description">Description</label>
                <textarea name="description" id="description" placeholder="Enter your predicament description" cols="30" rows="10"></textarea>
            </div>
            <input type="hidden" value="<?php echo $_SESSION['id'];?>" name="farmerid">
            <input type="submit" value="Add Predicament" name="submit"/>
        </form>

    </div>
</div>
<?php
//include('layout/footer.php');
?>
