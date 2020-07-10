<?php
require(realpath(__DIR__)."/../class/User.php");
require(realpath(__DIR__)."/../config/Session.php");
require(realpath(__DIR__)."/../config/Bootstrap.php");
$user = new User();
if($user->createUser($_POST)){
    Session::addMsg('Usuário criado com sucesso');
}else{
    Session::addMsg('Ocorreu um erro ao criar o usuário','danger');
}

header('Location: ' . getenv('INDEX').'templates/login.php');