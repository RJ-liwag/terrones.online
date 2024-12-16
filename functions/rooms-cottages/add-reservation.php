<?php

// Include necessary files
include '../../conn.php';
require '../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Retrieve POST data
$reference_number = $_POST['reference_number'] ?? "";
$name = $_POST['name'] ?? "";
$roomName = $_POST['room_name'] ?? "";
$address = $_POST['address'] ?? "";
$email = $_POST['email'] ?? "";
$type = $_POST['type'] ?? "";
$phone = $_POST['phone'] ?? "";
$room_id = $_POST['room_id'] ?? "";
$check_in = $_POST['check_in'] ?? "";
$check_out = $_POST['check_out'] ?? "";
$tour_type = $_POST['tour_type'] ?? "";
$rPax = $_POST['rPax'] ?? "";

// Format dates
$check_in = date('Y-m-d', strtotime($check_in));
$check_out = date('Y-m-d', strtotime($check_out));

// Create JSON array for reservation_date
$reservation_date = json_encode([$check_in, $check_out]);
$created_date = date('Y-m-d');

// Database query
$inquiry = $mysqli->query("INSERT INTO tbl_reservations (
    reference_number, facility_id, name, tour_type, pax, facility_name, reservation_date, created_date, email, type, phone, address, status, ref
) VALUES (
    '$reference_number', '$room_id', '$name', '$tour_type', '$rPax','$roomName', '$reservation_date', '$created_date', '$email', '$type', '$phone', '$address', 'pending', '1'
)");

if ($inquiry) {
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
        $mail->addCC($email);

        // Embed the image
        $mail->addEmbeddedImage('TerrenesLogo.png', 'logo_cid');

        $mail->isHTML(true);
        $mail->Subject = 'Reservation Confirmation - Terrones Resort';
        $mail->Body = "
        <div style='font-family: Arial, sans-serif; color: #333;'>
            <h2 style='color: #0056b3;'>Reservation Confirmation</h2>
            <hr style='border: 0; height: 1px; background: #ddd; margin: 10px 0;'>
            <div style='text-align: center; margin-bottom: 20px;'>
                <img src='cid:logo_cid' alt='Terrones Resort Logo' style='max-width: 200px;'>
            </div>
            <p>Dear <strong>$name</strong>,</p>
            <p>Thank you for choosing Terrones Resort for your stay! We are pleased to confirm your reservation with the following details:</p>
            <table style='width: 100%; border-collapse: collapse; margin: 20px 0;'>
                <tr>
                    <td style='padding: 8px; border: 1px solid #ddd;'><strong>Reference Number:</strong></td>
                    <td style='padding: 8px; border: 1px solid #ddd;'>$reference_number</td>
                </tr>
                <tr>
                    <td style='padding: 8px; border: 1px solid #ddd;'><strong>Tour Type:</strong></td>
                    <td style='padding: 8px; border: 1px solid #ddd;'>$tour_type</td>
                </tr>
                <tr>
                    <td style='padding: 8px; border: 1px solid #ddd;'><strong>No. of Guests:</strong></td>
                    <td style='padding: 8px; border: 1px solid #ddd;'>$rPax</td>
                </tr>
                <tr>
                    <td style='padding: 8px; border: 1px solid #ddd;'><strong>Check-In:</strong></td>
                    <td style='padding: 8px; border: 1px solid #ddd;'>$check_in</td>
                </tr>
                <tr>
                    <td style='padding: 8px; border: 1px solid #ddd;'><strong>Check-Out:</strong></td>
                    <td style='padding: 8px; border: 1px solid #ddd;'>$check_out</td>
                </tr>
            </table>
            <p>We are excited to host you and ensure your stay is comfortable and enjoyable.</p>
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
        echo 'email_failed';
    }
} else {
    echo 'db_error';
}
?>
