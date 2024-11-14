<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer library files
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = htmlspecialchars($_POST['name']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Create an instance of PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.outlook.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'travell@outlook.in';    // Your Gmail address
        $mail->Password = 'Wensil@1066';          // Gmail App Password if using 2FA, otherwise your Gmail password
        $mail->SMTPSecure = 'tls';                      // Use 'tls' for port 587
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('travell@outlook.in', 'Travell Contact Form');
        $mail->addAddress('travell@outlook.in');   // Your email to receive the messages

        // Content
        $mail->isHTML(false);  // Plain text email
        $mail->Subject = "New Contact Request from Travell Website";
        $mail->Body = "Name: $name\nPhone: $phone\nEmail: $email\n\nMessage:\n$message";

        // Send the email
        $mail->send();
        echo "Thank you! Your message has been sent.";
    } catch (Exception $e) {
        echo "Message could not be sent. Error: {$mail->ErrorInfo}";
    }
}
?>
