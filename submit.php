<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer files
require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['rName'];
    $email = $_POST['rEmail'];
    $phone = $_POST['rPhone'];
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];

    // Create an instance of PHPMailer
    $mail = new PHPMailer(true);
    
    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'your-email@gmail.com';  // Your Gmail address
        $mail->Password = 'your-app-password';     // Gmail App password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        
        // Sender and recipient details
        $mail->setFrom('your-email@gmail.com', 'Your Name or Company');
        $mail->addAddress($email, $name);  // Send confirmation to user
        
        // Email subject & body
        $mail->isHTML(true);
        $mail->Subject = 'Reservation Confirmation';
        $mail->Body = "
            <h1>Reservation Confirmation</h1>
            <p>Thank you, $name, for your reservation!</p>
            <p><strong>Check-in:</strong> $checkin<br><strong>Check-out:</strong> $checkout</p>
            <p>Contact No.: $phone</p>
        ";
        
        // Send email
        $mail->send();
        echo 'Reservation confirmation email has been sent.';

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
