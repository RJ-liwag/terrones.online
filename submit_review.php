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

// Get JSON input
$data = json_decode(file_get_contents("php://input"), true);

// Validate and sanitize data
$name = isset($data["name"]) ? $data["name"] : null;
$comment = isset($data["comment"]) ? $data["comment"] : null;
$rating = isset($data["rating"]) && is_numeric($data["rating"]) ? (int) $data["rating"] : null;

// Check if required fields are provided
if ($name && $comment && $rating !== null) {
    // Prepare the SQL statement
    $stmt = $mysqli->prepare("INSERT INTO reviews (name, comment, rating, created_at, ref) VALUES (?, ?, ?, NOW(), '1')");
    if ($stmt) {
        // Bind the parameters
        $stmt->bind_param("ssi", $name, $comment, $rating);

        // Execute the statement
        if ($stmt->execute()) {
            echo json_encode(["success" => true, "comment" => "Review submitted successfully."]);
        } else {
            echo json_encode(["success" => false, "comment" => "Failed to insert review."]);
        }

        // Close the statement
        $stmt->close();
    } else {
        echo json_encode(["success" => false, "comment" => "Failed to prepare SQL statement."]);
    }
} else {
    echo json_encode(["success" => false, "comment" => "Invalid input. All fields are required."]);
}

$mysqli->close();
?>
