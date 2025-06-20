<?php
if (session_id() == "") {
    session_start();
}

class Session {

    public function login($role, $email) {
        if (isset($role) && isset($email)) {
            $_SESSION['role'] = $role;
            $_SESSION['email'] = $email;
        }
    }



    public function logout() {
        unset($_SESSION['role']);
        unset($_SESSION['email']);
    }

    public function isUserLoggedIn() {
        return isset($_SESSION['email']) && isset($_SESSION['role']);
    }

    public function flashMessage($type, $message) {
        $_SESSION['msg'] = ['type' => $type, 'message' => $message];
    }

    public function getFlashMessage() {
        if (isset($_SESSION['msg'])) {
            $msg = $_SESSION['msg'];
            unset($_SESSION['msg']);
            return $msg;
        }
        return null;
    }
}
?>
