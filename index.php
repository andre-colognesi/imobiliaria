<?php
ini_set('error_reporting', E_ALL);
define('PATH',dirname(__FILE__));
define('DS',DIRECTORY_SEPARATOR);
include_once realpath(__DIR__).DS."app".DS."helper".DS."Helper.php";
include_once 'app/Bootstrap.php';
$url = $_SERVER['REQUEST_URI'];
//----apenas em ambiente dev
$break = explode('/',$url);
    $url = "";
    $len = count($break);
    for($i = 2; $i < $len; $i++){
        $url .= "/".$break[$i];
        //$i == 2 ? $url .= $break[$i] : $url.= "/".$break[$i];
    }
//--fim
$sanitzer = new app\web\Request();
$sanitzer->setUrl($url);
$rota = new app\web\Rota;
$rota->addRota('GET','home','HomeController@home');
$rota->addRota('GET','pessoa','PessoaController@read');
$rota->addRota('GET','','LoginController@displayLogin');
$rota->addRota('GET','login','LoginController@displayLogin');
$rota->addRota('POST','check-login','LoginController@login');
$rota->addRota('GET','cadastrar-login','LoginController@displayRegister');
$rota->addRota('POST','criar-usuario','LoginController@register');
$rota->addRota('GET','logout','LoginController@logout');
$rota->addRota('GET','configuracao','UserController@userConfig');
$rota->addRota('POST','atualizar-usuario','UserController@updateUser');
$rota->addRota('GET','imovel/novo','PropertieController@createForm');
$rota->addRota('POST','imovel/criar','PropertieController@addPropertie');
$rota->addRota('GET','imoveis',"PropertieController@allProperties");
$rota->addRota('GET','imovel/{id}',"PropertieController@getPropertie");
$rota->addRota('POST','imovel/{id}/atualizar',"PropertieController@updatePropertie");
$rota->execRota($sanitzer->getUrl());

