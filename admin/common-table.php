<!-- common-table.php -->
<?php
// $sql = "SELECT * FROM `$table`";
// $result = mysqli_query($conn, $sql);

// if ($result && mysqli_num_rows($result) > 0) {
//     $columns = array_keys(mysqli_fetch_assoc($result));
//     mysqli_data_seek($result, 0);

//     $excludedColumns = ['password', 'id', 'reset_otp_hash', 'reset_otp_expires_at'];

//     echo "<tr><th>SN</th>";
//     foreach ($columns as $column) {
//         if (!in_array($column, $excludedColumns)) {
//             echo "<th>" . strtoupper($column) . "</th>";
//         }
//     }
//     echo "<th>ACTION</th>";
//     echo "</tr>";

//     $i = 1;
//     while ($row = mysqli_fetch_assoc($result)) {
//         echo "<tr><td>$i</td>";
//         foreach ($row as $column => $value) {
//             if (!in_array($column, $excludedColumns)) {
//                 echo "<td>$value</td>";
//             }
//             if ($column === 'id' || $column === 'gid') {
//                 $id = $value;
//             }
//         }
        // echo "<td class='td-center'>
        //     <form action='' method='post' class='deleteBtn' onsubmit=\"confirmDelete(event)\">
        //         <input type='hidden' name='action' value='delete'>
        //         <input type='hidden' name='id' value='" . $id . "'> <!-- Sending id -->
        //         <input type='hidden' name='deleteTable' value='" . $table . "'> <!-- Sending table selected -->
        //         <button type='submit'>Delete</button>
        //     </form>
        // </td>";

//         echo "</tr>";
//         $i++;
//     }
// } else {
//     echo "<td>No data to display.</td>";
// }
?>
