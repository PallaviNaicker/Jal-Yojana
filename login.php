<?php
// Start session
session_start();

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_details";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize form data
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);
    
    // Query to check if the user exists
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // User exists, start a session
        $_SESSION['username'] = $username;

        // Fetch data from details table
        $details_sql = "SELECT * FROM details";
        $details_result = $conn->query($details_sql);

        // Fetch data from feedback table
        $feedback_sql = "SELECT * FROM feedback";
        $feedback_result = $conn->query($feedback_sql);
        
        // Include the HTML to display data
        include('display_data.php');
    } else {
        echo "Invalid username or password.";
    }
}

// Close the connection
$conn->close();
?>
