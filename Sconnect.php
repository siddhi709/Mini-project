<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ssheets";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch data from tables
$sql = "SELECT `Slot No` AS `Slots`, `Last Updated` AS `LastUpdated` FROM monday 
        UNION 
        SELECT `Slot No` AS `Slots`, `Last Updated` AS `LastUpdated` FROM tuesday";

$result = mysqli_query($conn, $sql);

$rows = array();
while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
}

mysqli_close($conn);

// Return JSON response
header('Content-Type: application/json');
echo json_encode($rows);
?>
