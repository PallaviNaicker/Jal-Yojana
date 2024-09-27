<?php
       include 'db.php';

       $sql = "SELECT * FROM posts";
       $result = $conn->query($sql);

       $posts = array();
       while($row = $result->fetch_assoc()) {
           $row['comments'] = array(); // Initialize comments array
           $posts[] = $row;
       }

       echo json_encode($posts);
       $conn->close();
       ?>
       
