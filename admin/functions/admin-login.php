<?php
session_start();

include '../../conn.php';

// Collect input
$username = $_POST['username'];
$password = $_POST['password'];

$query = $mysqli->prepare("SELECT * FROM admin_account WHERE username = ?;");
$query->bind_param("s", $username);
$query->execute();
$result = $query->get_result();

$response = array();

if ($result) {
    if ($result->num_rows > 0) {
        $row = $result->fetch_array();
        $hashpass = $row['password'];
        // Verify the password
        if (password_verify($password, $hashpass)) {
            // Set session variables for authenticated user
            $_SESSION['username'] = $row['username'];
            $_SESSION['id'] = $row['id'];
            $response['status'] = 'success';
            $response['redirect'] = './index';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Invalid username or password';
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Invalid username or password';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = "ERROR: " . $mysqli->error;
}

// Close the prepared statement
$query->close();

// Return response as JSON
echo json_encode($response);
?>
