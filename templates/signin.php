<?php

require(realpath(__DIR__)."/../class/User.php");
require(realpath(__DIR__)."/../config/Session.php");
require(realpath(__DIR__)."/../config/Bootstrap.php");
$user = new User();
$res = $user->login($_POST);

if($res){
    $session = new Session();
    $session->createSession($res);
    Session::addMsg('Bem vindo '.$_SESSION['USERNAME'].'',"success");
    header('Location: ' . getenv('INDEX').'templates/home.php');
}else{
    Session::addMsg('Usúario ou senha inválidos',"warning");
    header('Location: ' . getenv('INDEX').'templates/login.php');
}