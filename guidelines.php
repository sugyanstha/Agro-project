<?php
include('layout/header.php');
include('layout/left.php');

$conn = new mysqli("localhost","root","","agro_council");

$sql ="SELECT predicament.pid, predicament.title, guidelines.id, guidelines.description, guidelines.counselor_id
FROM predicament
INNER JOIN guidelines ON predicament.pid = guidelines.predicament_id";

$result = $conn->query($sql);
if ($result) {
    echo "<div>
            <h1>Guidelines</h1>
            <table>
            <tr>
                <th>Problems</th>
                <th>Guidelines</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        $probTits = $row['title'];
        $guidelinesdesp = $row['description'];
    
        // Displaying
        echo "
            <tr>
                <td>" . $probTits . "</td>
                <td>" . $guidelinesdesp . "</td>
            </tr>
            </table>
        </div>";
    }
    
} else {
    // Handle the case when the query fails
}
include('layout/footer.php');
?>
