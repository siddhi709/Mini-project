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

// Check if rollNumber, columnName, and value are set and not empty
if (isset($_POST['rollNumber']) && !empty($_POST['rollNumber']) && isset($_POST['columnName']) && !empty($_POST['columnName']) && isset($_POST['value']) && !empty($_POST['value'])) {
    $rollNumber = $_POST['rollNumber'];
    $columnName = $_POST['columnName'];
    $value = $_POST['value'];
    
    // Prepare the SQL statement to update the value in the database
    $stmt = $conn->query("UPDATE cn SET ? = ? WHERE Roll = ?");
    $stmt->bind_param("ss", $columnName,$value,$rollNumber);
    echo $stmt;
    $stmt.execute();
    // Execute the statement
    //if ($stmt.execute()) {
    //    echo "Data updated successfully";
    //} else {

//        echo "Error updating data: " . $conn->error;
  //  }

    // Close the statement
    $conn->close();
} else {
    echo "Invalid data received";
}

// Close the connection
$conn->close();
?>
