<?php
header('Access-Control-Allow-Origin: *'); 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "slots";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the 'slot' parameter is set and select the appropriate table
if (isset($_GET['slot'])) {
    $slot = $_GET['slot'];
    $table = '';
    switch ($slot) {
        case 'slot1':
            $table = 'cn';
            break;
        case 'slot2':
            $table = 'cn2';
            break;
        case 'slot11':
            $table = 'cn3';
            break;
        default:
            // Handle unknown slot value or set a default table
	    $table = 'cn2';
            break;
    }

    // If a valid table is selected, query the database
    if ($table != '') {
        $sql = "SELECT Roll, Name FROM $table";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row as table rows
            while($row = $result->fetch_assoc()) {
                echo "<tr><td contenteditable='true'>" . $row["Roll"]. "</td><td contenteditable='true'>" . $row["Name"]. "</td><td></td></tr>";
            }
        } else {
            echo "0 results";
        }
    }
}

$conn->close();
?>
