<?php

include_once "config/Session.php";
include_once "config/Bootstrap.php";
$session = new Session();
if($session->startSession()){
    header("location:".getenv('INDEX')."templates/home.php");
}else{
    header("location:".getenv('INDEX')."templates/login.php");
}
