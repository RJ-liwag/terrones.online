<?php
header('Content-Type: application/json');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("conn.php");

// Check for connection errors
if ($mysqli->connect_error) {
    echo json_encode(["success" => false, "comment" => "Database connection failed"]);
    exit;
}

// Retrieve and sanitize POST data
$confirmed_refnos = isset($_POST['confirmed_refnos']) ? $_POST['confirmed_refnos'] : "";

// Prepare the SQL statement
$stmt = $mysqli->prepare("SELECT reference_number FROM tbl_reservations WHERE reference_number = ?");
if ($stmt) {
    // Bind the parameters
    $stmt->bind_param("s", $confirmed_refnos);

    // Execute the statement
    $stmt->execute();

    // Store the result
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo json_encode(["success" => true, "message" => "Reference Number Found!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Reference Number Not Found!"]);
    }

    // Close the statement
    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Failed to prepare the SQL statement"]);
}

// Close the database connection
$mysqli->close();
?>
