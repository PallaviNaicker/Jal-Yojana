<?php
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);

if (isset($input['name']) && isset($input['content'])) {
    // Simulate saving to a database
    $newPost = [
        'id' => rand(1, 1000), // Simulate an ID
        'name' => $input['name'],
        'content' => $input['content'],
        'likes' => 0,
        'comments' => []
    ];

    // Return the new post as a JSON response
    echo json_encode($newPost);
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid input']);
}
?>