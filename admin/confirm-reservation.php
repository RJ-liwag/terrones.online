<?php
include_once("../conn.php");
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$data_id = $_POST['data_id'] ?? "";

$sql = $mysqli->query("UPDATE tbl_reservations SET status = 'Approved' WHERE id = '$data_id'");

$sql2 = $mysqli->query("SELECT * FROM tbl_reservations WHERE id = '$data_id'");

if ($sql2) {
    while ($row = $sql2->fetch_assoc()) {
        $user_email =  $row['email'] ? $row['email'] : "";
        $user_name =  $row['name'] ? $row['name'] : "";
    }
} else {
    echo "Error: " . $mysqli->error;
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
            <h3 style='color: #5bc0de; text-align: center;'>Reservation Confirmation</h3>
            <p>Dear <strong>$user_name</strong>,</p>
            <p>We confirmed your reservation at <strong>Terrones Resort</strong>!</p>
            <p>Your booking status is now <strong style='color: #5bc0de;'>Confirmed</strong>.</p>
            <p>We are excited to welcome you and ensure you have a wonderful stay at our resort.</p>
            <p>We look forward to your visit and are excited to host you at Terrones Resort!</p>
            <p>If you have any questions or need further assistance, please feel free to contact us.</p>
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
