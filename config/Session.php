<?php

class Session{

    public function __construct()
    {
        session_start();
    }

    public function checkSession(){
        if(!isset($_SESSION['USERNAME']) || !isset($_SESSION['EMAIL']) || !isset($_SESSION['ID'])){
            return false;
        }
        return true;
    }

    public static function addMsg($msg,$type = "success"){
        session_start();
        $_SESSION['message'] = array(
            'message' => $msg,
            'type' => $type
        );
    }

    public static function showMsg(){
        if(isset($_SESSION['message'])){
            $display = '<div class="row mx-5 px-5">
                <dib class="col-sm-12 text-center alert alert-'.$_SESSION['message']['type'].'">'.$_SESSION['message']['message'].'</div>';
                echo $display;
                unset($_SESSION['message']);
            }

    }

    public function createSession(array $user){

        $_SESSION['USERNAME'] = $user['name'];
        $_SESSION['EMAIL'] = $user['email'];
        $_SESSION['ID'] = $user['user_id'];

        $this->checkSession();
    }

    public function logout(){
        unset($_SESSION['USERNAME']);
        unset($_SESSION['EMAIL']);
        unset($_SESSION['ID']);
        $this->checkSession();
    }

}