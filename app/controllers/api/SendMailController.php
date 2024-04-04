<?php

namespace App\Controllers\Api;

use PHPMailer\PHPMailer\PHPMailer;

require_once __DIR__ . '/../../vendor/PHPMailer-master/src/PHPMailer.php';
require_once __DIR__ . '/../../vendor/PHPMailer-master/src/Exception.php';
require_once __DIR__ . '/../../vendor/PHPMailer-master/src/SMTP.php';
require_once __DIR__ . '/ApiBaseController.php';

class SendMailController extends ApiBaseController
{
    private $config;

    public function __construct()
    {
        $file = __DIR__ . '/../../../app/config/mail.php';
        if (file_exists($file)) {
            $this->config = require $file;
        } else {
            // Handle the case where the file doesn't exist
            echo "Error: Configuration file not found!";
            exit; // Terminate execution since configuration is essential
        }
    }

    public function sendEmail($email)
    {
        // Create a new PHPMailer instance
        $mail = new PHPMailer;

        // Set up the SMTP settings using the configuration from mail.php
        $mail->isSMTP();
        $mail->Host = $this->config['host'];
        $mail->Port = $this->config['port'];
        $mail->SMTPSecure = $this->config['SMTPSecure'];
        $mail->SMTPAuth = $this->config['SMTPAuth'];
        $mail->Username = $this->config['username'];
        $mail->Password = $this->config['password'];

        // Set the From and Reply-To addresses
        $mail->setFrom($this->config['from_email'], $this->config['from_name']);
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
            return 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
        } else {
            return 'Message has been sent';
        }
    }
}
