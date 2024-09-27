<!DOCTYPE html>
<html>
<head>
    <title>Display Data from SQL Tables</title>
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid black;
            padding: 10px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    
    <h2>Details Table</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Phone Number</th>
            <th>Address</th>
            <th>Pincode</th>
            <th>Longitude</th>
            <th>Latitude</th>
            <th>Problem Description</th>
            <th>Image</th>
        </tr>
        <?php
        if ($details_result->num_rows > 0) {
            // Output data of each row
            while($row = $details_result->fetch_assoc()) {
                echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name"]. "</td><td>" . $row["phone_number"]. "</td><td>" . $row["address"]. "</td><td>" . $row["pincode"]. "</td><td>" . $row["longitude"]. "</td><td>" . $row["latitude"]. "</td><td>" . $row["problem"]. "</td><td><img src='" . $row["image_path"] . "' alt='User Image' style='width:100px;height:100px;'></td></tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No details found</td></tr>";
        }
        ?>
    </table>

    <h2>Feedback Table</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Feedback</th>
        </tr>
        <?php
        if ($feedback_result->num_rows > 0) {
            // Output data of each row
            while($row = $feedback_result->fetch_assoc()) {
                echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name"]. "</td><td>" . $row["email"]. "</td><td>" . $row["feedback"]. "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No feedback found</td></tr>";
        }
        ?>
    </table>
</body>
</html>