<?php
// Create a connection
$conn = new mysqli("localhost", "root", "", "faculty_login");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the submitted username and password
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare a SQL query to select the user from the teacher table
    $sql = "SELECT * FROM teacher WHERE username = ? AND password = ?";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind the parameters
    $stmt->bind_param("ss", $username, $password);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows > 0) {
        // Start a session
        session_start();
        // Set session variable to indicate user is logged in
        $_SESSION['loggedin'] = true;
        // Redirect to the attendance management system page
        header("Location: f2-4-2.html");
        exit();
    } else {
        echo "Login failed...No user found";
    }
}

// Close the statement and the connection
$stmt->close();
$conn->close();
?>