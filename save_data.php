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

// Check if data and columnName are set and not empty
if (isset($_POST['data']) && !empty($_POST['data']) && isset($_POST['columnName']) && !empty($_POST['columnName'])) {
    $data = json_decode($_POST['data'], true);
    $columnName = $_POST['columnName'];

    // Prepare the SQL statement to insert data into the new column
    $stmt = $conn->prepare("UPDATE cn SET $columnName = ? WHERE Roll = ?");

    // Bind parameters and execute the statement for each row of data
    $affectedRows = 0;
    foreach ($data as $row) {
        $newColumnValue = $row[$columnName];
        $rollNumber = $row['Roll'];

        $stmt->bind_param("ss", $newColumnValue, $rollNumber);
        $stmt->execute();
        
        $affectedRows += $stmt->affected_rows;
    }

    // Check if all updates were successful
    if ($affectedRows > 0) {
        echo "Data saved successfully";
    } else {
        echo "Error updating data";
    }

    // Close the statement
    $stmt->close();
} else {
    echo "No data received or column name not specified";
}

// Close the connection
$conn->close();
?>
