<?php
include '../../conn.php';

// Collecting the input values
$user_name = isset($_POST['user_name']) ? $_POST['user_name'] : "";
$user_email = isset($_POST['user_email']) ? $_POST['user_email'] : "";
$user_mobileno = isset($_POST['user_mobileno']) ? $_POST['user_mobileno'] : "";
$user_subject = isset($_POST['user_subject']) ? $_POST['user_subject'] : "";
$user_message = isset($_POST['user_message']) ? $_POST['user_message'] : "";

date_default_timezone_set("Asia/Manila");
$datenow = date('F j, Y') . " | " . date("h:i A");

// Prepare the SQL query using placeholders
$sql = "INSERT INTO user_inquries (user_name, user_email, user_mobileno, user_subject, user_message, created_date, status) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";

// Prepare the statement
$stmt = $mysqli->prepare($sql);

// Check if the statement was prepared successfully
if ($stmt === false) {
    echo "Error preparing the query: " . $mysqli->error;
    exit;
}

// Bind the parameters to the placeholders in the query
// "ssssssi" specifies the types of the parameters (s for string, i for integer)
$stmt->bind_param("ssssssi", 
    $user_name, 
    $user_email, 
    $user_mobileno, 
    $user_subject, 
    $user_message, 
    $datenow, 
    $status = 1 // Hardcoded as 1 for status
);

// Execute the query
if ($stmt->execute()) {
    echo "Successful";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement
$stmt->close();
?>
