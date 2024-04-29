<?php
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

// Check if columnName is set and not empty
if (isset($_POST['columnName']) && !empty($_POST['columnName'])) {
    $columnName = $_POST['columnName'];

    // Prevent deletion of columns with index 1 and 2
    if ($columnName === 'Roll Number' || $columnName === 'Student Name') {
        echo "Error: Cannot delete this column.";
    } else {
        // Remove the column from the database table
        $sql = "ALTER TABLE cn DROP COLUMN $columnName";
        if ($conn->query($sql) === TRUE) {
            echo "Column deleted successfully";
        } else {
            echo "Error deleting column: " . $conn->error;
        }
    }
}

$conn->close();
?>
