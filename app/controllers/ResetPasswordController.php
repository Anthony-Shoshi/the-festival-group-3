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
                $this->userService->resetPassword($user);
                header("Location: /login");
                exit();
            } else {
                header("Location: /error?message=Invalid email address");
                exit();
            }
        } else {
            require_once __DIR__ . '/../views/ResetPassword.php';
        }
    }
}