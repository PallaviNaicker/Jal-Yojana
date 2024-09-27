<?php
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
    // Validate required fields
    $required_fields = ['name', 'email', 'feedback'];
    $missing_fields = [];
    
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $missing_fields[] = $field;
        }
    }
    
    if (empty($missing_fields)) {
        // Sanitize form data
        $name = $conn->real_escape_string($_POST['name']);
        $email = $conn->real_escape_string($_POST['email']);
        $feedback = $conn->real_escape_string($_POST['feedback']);
        
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO feedback (name, email, feedback) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $feedback);
        
        // Execute the statement
        if ($stmt->execute()) {
            echo "Feedback submitted successfully";
        } else {
            echo "Error: " . $stmt->error;
        }
        
        // Close the statement
        $stmt->close();
    } else {
        echo "Required fields are missing: " . implode(', ', $missing_fields);
    }
}

// Close the connection
$conn->close();
?>
