<?php

class Session{

    public function __construct()
    {
        session_start();
    }

    public function startSession(){
        if(!isset($_SESSION['USERNAME']) || !isset($_SESSION['EMAIL'])){
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
        session_start();
        if(isset($_SESSION['message'])){
            $display = '<div class="row mx-5 px-5">
                <dib class="col-sm-12 text-center alert alert-'.$_SESSION['message']['type'].'">'.$_SESSION['message']['message'].'</div>';
                echo $display;
                unset($_SESSION['message']);
            }

    }

    public function createSession(){

    }

}