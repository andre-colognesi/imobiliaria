<?php

include_once "config/Session.php";
$session = new Session();
if($session->startSession()){
    header("location: home.php");
}else{
    header("location: login.php");
}
