<?php
       include 'db.php';

       $postId = $_GET['id'];

       $sql = "UPDATE posts SET likes = likes + 1 WHERE id = $postId";
       if ($conn->query($sql) === TRUE) {
           $sql = "SELECT * FROM posts WHERE id = $postId";
           $result = $conn->query($sql);
           $post = $result->fetch_assoc();
           echo json_encode($post);
       } else {
           echo json_encode(array('error' => $conn->error));
       }

       $conn->close();
       ?>
