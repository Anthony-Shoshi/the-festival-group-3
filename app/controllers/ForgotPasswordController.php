<?php

namespace App\Controllers;
use App\services\UserService;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
require_once __DIR__ . '/../vendor/PHPMailer-master/src/PHPMailer.php';
require_once __DIR__ . '/../vendor/PHPMailer-master/src/Exception.php';
require_once __DIR__ . '/../vendor/PHPMailer-master/src/SMTP.php';


class ForgotPasswordController
{
    private UserService $forgotPasswordService;

    public function __construct()
    {
        $this->forgotPasswordService = new userService();
    }

    public function resetPassword()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['email'])) {
            $email = $_POST['email'];
            $user = $this->forgotPasswordService->getUserByEmail($email);
            if ($user) {
                // Generate a unique token for password reset link
                $token = bin2hex(random_bytes(32));
                // Save the token with the user's email in a temporary storage
                $_SESSION['password_reset_token'] = $token;
                $_SESSION['email'] = $email;

                $reset_link = "http://localhost/ForgotPassword/setNewPassword?token=$token";

                $this->sendResetPasswordEmail($email, $reset_link);

                header("Location: /password-reset-sent");
                exit();
            } else {
                $error = "Invalid email address";
            }
        }

        require_once __DIR__ . '/../views/reset-password.php';
    }


    private function sendResetPasswordEmail($email, $reset_link): void
    {
        $user = $this->forgotPasswordService    ->getUserByEmail($email);
        $name = $user['name'];

        // Instantiate PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'thefestival918@gmail.com';
            $mail->Password   = 'FesDival918';
            $mail->SMTPSecure = 'ssl';  //maybe tls and 587
            $mail->Port       = 465;

            // Recipients
            $mail->setFrom('thefestival918@gmail.com', 'The Festival');
            $mail->addAddress($email, $name);

            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Request';
            $mail->Body    = "Dear $name,<br><br>Click the following link to reset your password: <a href='$reset_link'>$reset_link</a>";

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    public function setNewPassword()
    {
        // Logic for setting new password
    }
}
