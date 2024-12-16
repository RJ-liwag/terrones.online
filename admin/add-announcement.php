<?php
// Include database connection
include("../conn.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get data from POST request
    $title = $_POST['title'];
    $content = $_POST['content'];
    $expiry_date = $_POST['expiry_date'];
    $date_posted = $_POST['date_posted'];
    $username = 'admin'; // Replace with dynamic session if needed

    // SQL query to insert the announcement
    $query = "INSERT INTO announcements (title, content, username, date_posted ,expiry_date) 
              VALUES (?, ?, ?, ?,?)";

    // Prepare and execute the query
    if ($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param("sssss", $title, $content, $username, $date_posted ,$expiry_date);
        if ($stmt->execute()) {
            echo 'success';
        } else {
            echo 'error';
        }
        $stmt->close();
    } else {
        echo 'error';
    }
}
