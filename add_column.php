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

    // Sanitize the column name (optional in this case, since it's not directly user input)
    $columnName = $conn->real_escape_string($columnName);

    // Add the column to the database table
    $sql = "ALTER TABLE cn ADD $columnName VARCHAR(255)";
    if ($conn->query($sql) === TRUE) {
        // Insert default values for the new column based on button status
        $sqlInsert = "UPDATE cn SET $columnName = 'A'";
        if ($conn->query($sqlInsert) === TRUE) {
            echo "Column added successfully";
        } else {
            echo "Error adding column values: " . $conn->error;
        }
    } else {
        echo "Error adding column: " . $conn->error;
    }
}

$conn->close();
?>
