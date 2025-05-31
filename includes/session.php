<?php
if(session_id() == ""){
    session_start();
}
class Session{
    private $user_is_logged_in = false;

    public function login($name, $email){
        $_SESSION['username'] = $name;
        $_SESSION['email'] = $email;

        $this->user_is_logged_in = true;
    }

    public function logout(){
        unset($_SESSION['username']);
        unset($_SESSION['email']);
    }

    public function isUserLogedIn(){
        $this->user_is_logged_in;
    }

    public function flashMessage($type, $message){
        $_SESSION['msg'] = ['type'=>$type, 'message'=>$message];
    }

    public function getFlashMessage(){
        if(isset($_SESSION['msg'])){
            $msg = $_SESSION['msg'];
            unset($_SESSION['msg']);
            return $msg;
        }
        return null;
    }
}

?>