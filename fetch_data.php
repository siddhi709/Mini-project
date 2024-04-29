<?php
include 'connect.php';

$slot = $_GET['slot'];

$sql = "";
if ($slot == 'slot1') {
    $sql = "SELECT * FROM cn";
} elseif ($slot == 'slot2') {
    $sql = "SELECT * FROM cn1";
}

$result = $conn->query($sql);

$rows = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
}

echo json_encode($rows);

$conn->close();
?>
