<?php
session_start();
include '../../conn.php';

$admin_id = isset($_POST['admin_id']) ? $_POST['admin_id'] : "";
$newUsername = isset($_POST['newUsername']) ? $_POST['newUsername'] : "";
$currentPass = isset($_POST['currentPass']) ? $_POST['currentPass'] : "";
$newPass = isset($_POST['newPass']) ? $_POST['newPass'] : "";
$confirmPass = isset($_POST['confirmPass']) ? $_POST['confirmPass'] : "";

// Retrieve the admin credentials
$admin_cred = $mysqli->query("SELECT * FROM admin_account WHERE id = '$admin_id'");

// Check if the query was successful and if a result was returned
if ($admin_cred && $admin_cred->num_rows > 0) {
    $row = $admin_cred->fetch_assoc();

    $currentUsername = $row['username'];
    $hashPass = $row['password'];

    // Verify the current password
    if (password_verify($currentPass, $hashPass)) {
        // Check if new password and confirm password match
        if ($newPass === $confirmPass) {
            $hashNewPass = password_hash($newPass, PASSWORD_BCRYPT);

            $admin_query = $mysqli->query("
            UPDATE admin_account
            SET
            username = '$newUsername',
            password = '$hashNewPass'
            WHERE id = '$admin_id'");

            if ($admin_query) {
                // Destroy the session after successful update
                session_destroy();
                echo "Successful";
            } else {
                echo "Error updating record: " . $mysqli->error;
            }
        } else {
            echo "Passwords do not match";
        }
    } else {
        echo "Invalid Credentials, Please double check";
    }
} else {
    echo "Invalid Credentials, Please double check";
}

$mysqli->close();
?>
