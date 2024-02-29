<?php
class ResetPasswordController
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function resetPassword()
    {
        if (isset($_POST['email'])) {
            $email = $_POST['email'];
            $user = $this->userService->getUserByEmail($email);
            if ($user) {
                // Generate a unique token for password reset link
                $token = bin2hex(random_bytes(32));
                // Save the token with the user's email in a temporary storage
                $_SESSION['password_reset_token'] = $token;
                $_SESSION['email'] = $email;

                // Construct the password reset link
                $reset_link = "<a href='http://localhost/setNewPassword'>Reset Password</a>";

                $this->sendResetPasswordEmail($email, $reset_link);

                header("Location: /password-reset-sent");
                exit();
            } else {
                header("Location: /error?message=Invalid email address");
                exit();
            }
        } else {
            require_once __DIR__ . '/../views/ResetPassword.php';
        }
    }
    private function sendResetPasswordEmail($email, $reset_link): void
    {
        $user = $this->userService->getUserByEmail($email);
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
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            // Recipients
            $mail->setFrom('your@example.com', 'Your Name');
            $mail->addAddress($email, $name);

            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Request';
            $mail->Body    = "Dear $name,<br><br>Click the following link to reset your password: <a href='$reset_link'>$reset_link</a>";

            $mail->send();
        } catch (Exception $e) {
            throw new Exception("Error: " . $mail->ErrorInfo);
        }
    }
    public function setNewPassword(){
    
    }

}