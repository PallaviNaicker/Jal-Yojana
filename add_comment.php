<?php
       include 'db.php';

       $data = json_decode(file_get_contents('php://input'), true);
       $postId = $data['post_id'];
       $comment = $data['comment'];

       $sql = "INSERT INTO comments (post_id, comment) VALUES ($postId, '$comment')";
       if ($conn->query($sql) === TRUE) {
           $sql = "SELECT * FROM comments WHERE post_id = $postId";
           $result = $conn->query($sql);
           $comments = array();
           while($row = $result->fetch_assoc()) {
               $comments[] = $row['comment'];
           }
           echo json_encode($comments);
       } else {
           echo json_encode(array('error' => $conn->error));
       }

       $conn->close();
       ?>
       
