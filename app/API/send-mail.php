<?php

use PHPMailer\PHPMailer\PHPMailer;

$config = require 'app/config/mail.php'; // Include your mail configuration file and load the configuration array

require_once __DIR__ . '/../vendor/PHPMailer-master/src/PHPMailer.php';
require_once __DIR__ . '/../vendor/PHPMailer-master/src/Exception.php';
require_once __DIR__ . '/../vendor/PHPMailer-master/src/SMTP.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve email from the form
    $email = $_POST['email'];

    // Create a new PHPMailer instance
    $mail = new PHPMailer;

    // Set up the SMTP settings using the configuration from mail.php
    $mail->isSMTP();
    $mail->Host = $config['host'];
    $mail->Port = $config['port'];
    $mail->SMTPSecure = $config['SMTPSecure'];
    $mail->SMTPAuth = $config['SMTPAuth'];
    $mail->Username = $config['username'];
    $mail->Password = $config['password'];

    // Set the From and Reply-To addresses
    $mail->setFrom($config['from_email'], $config['from_name']);
    $mail->addAddress($email);

    // Add the company logo as an attachment (assuming you have the path to the logo)
    $mail->addAttachment('/images/logo.png');

    // Set email content
    $mail->isHTML(true);
    $mail->Subject = 'Thank You for Subscribing!';
    $mail->Body = 'Thank you for subscribing to our newsletter! We are thrilled to have you join our community. 🎉

    By subscribing, you will receive regular updates on our latest events, exhibitions, and exclusive offers. Stay tuned for exciting news and valuable insights delivered straight to your inbox.

    If you ever have any questions or feedback, feel free to reach out to us. We are here to make your experience with us exceptional.

    Once again, thank you for subscribing! We look forward to keeping in touch.';

    // Send the email
    if (!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent';
    }
} else {
    header("Location: /home");
    exit;
}
?>