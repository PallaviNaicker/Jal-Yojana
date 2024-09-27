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
    // Debugging: Print received POST data
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    
    // Validate required fields
    $required_fields = ['name', 'phone_number', 'address', 'pincode', 'longitude', 'latitude', 'problem'];
    $missing_fields = [];
    
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $missing_fields[] = $field;
        }
    }
    
    if (empty($missing_fields) && isset($_FILES['upload']) && $_FILES['upload']['error'] == 0) {
        // Sanitize form data
        $name = $conn->real_escape_string($_POST['name']);
        $phone_number = $conn->real_escape_string($_POST['phone_number']);
        $address = $conn->real_escape_string($_POST['address']);
        $pincode = $conn->real_escape_string($_POST['pincode']);
        $longitude = $conn->real_escape_string($_POST['longitude']);
        $latitude = $conn->real_escape_string($_POST['latitude']);
        $problem = $conn->real_escape_string($_POST['problem']);
        
        // Handle file upload
        $image = $_FILES['upload'];
        $image_path = 'uploads/' . basename($image['name']);
        
        // Ensure the uploads directory exists
        if (!is_dir('uploads')) {
            mkdir('uploads', 0777, true);
        }
        
        if (move_uploaded_file($image['tmp_name'], $image_path)) {
            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO details (name, phone_number, address, pincode, longitude, latitude, problem, image_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssddss", $name, $phone_number, $address, $pincode, $longitude, $latitude, $problem, $image_path);
            
            // Execute the statement
            if ($stmt->execute()) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $stmt->error;
            }
            
            // Close the statement
            $stmt->close();
        } else {
            echo "Failed to upload image.";
        }
    } else {
        echo "Required fields are missing: " . implode(', ', $missing_fields);
    }
}

// Close the connection
$conn->close();
?>