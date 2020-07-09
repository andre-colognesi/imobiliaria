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

}