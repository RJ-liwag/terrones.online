<?php
include_once("../conn.php");
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$data_id = $_POST['data_id'] ?? "";

// Update reservation status to "Cancelled"
$sql = $mysqli->query("UPDATE tbl_reservations SET status = 'Not Approved' WHERE id = '$data_id'");

// Retrieve the reservation details
$sql2 = $mysqli->query("SELECT * FROM tbl_reservations WHERE id = '$data_id'");

if ($sql2) {
    $row = $sql2->fetch_assoc();
    $user_email = $row['email'] ?? "";
} else {
    echo "Error: " . $mysqli->error;
    exit;
}

if ($sql) {
    $mail = new PHPMailer(true);

    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'theterronesresort3@gmail.com';
        $mail->Password = 'ukbg cxqz oxdd negz';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('theterronesresort3@gmail.com','theterronesresort3@gmail.com');
        $mail->addCC('theterronesresort3@gmail.com','theterronesresort3@gmail.com');
        $mail->addAddress($user_email);

        // Embed the image
        $mail->addEmbeddedImage('TerrenesLogo.png', 'logo_cid'); // Update the path to the actual image

        $mail->isHTML(true);
        $mail->Subject = 'Reservation Cancellation - Terrones Resort';

        // Email body
        $mail->Body = "
        <div style='font-family: Arial, sans-serif; color: #333;'>
            <div style='text-align: center; margin-bottom: 20px;'>
                <img src='cid:logo_cid' alt='Terrones Resort Logo' style='max-width: 200px;'>
            </div>
            <h3 style='color: #d9534f; text-align: center;'>Reservation Cancellation</h3>
            <p>Dear Guest,</p>
            <p>We regret to inform you that your reservation at <strong>Terrones Resort</strong> has been Not Approved.</p>
            <p>Your booking status is now updated to <strong style='color: #d9534f;'>Not Approved</strong>.</p>
            <p>We apologize for any inconvenience this may cause. Please feel free to reach out to us if you have any questions or need further assistance.</p>
            <p style='margin-top: 20px;'>Warm regards,</p>
            <p><strong>Terrones Resort Team</strong></p>
        </div>
        ";

        // Send email
        if ($mail->send()) {
            echo 'success';
        } else {
            echo 'email_failed';
        }
    } catch (Exception $e) {
        echo 'email_failed' . $mail->ErrorInfo;
    }
} else {
    echo 'db_error';
}
?>
