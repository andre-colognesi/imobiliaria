<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once "Autoload.php";
class Bootstrap
{
    
    protected $url;
    protected $indexUrl;
    public function __CONSTRUCT(){
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') 
        $link = "https"; 
    else
        $link = "http"; 
        $link .= "://"; 
        $link .= $_SERVER['HTTP_HOST']; 
        $link .= $_SERVER['REQUEST_URI']; 
        putenv("FULLURL=".$link);
        putenv("URL=//localhost/imobiliaria/");
        spl_autoload_register('Autoload::loader');
        date_default_timezone_set("UTC");
}

    public static function server(){
        foreach($_SERVER as $index => $value){
            echo '<b>'.$index.'</b>: '.$value.'<br>';
        }
    }

    public function setUrl($url){
        $url = explode("?",$url);
        $this->url = $url[0];
    }

    public function getUrl(){
        return $this->url;
    }

    public function setIndex($path){
        $this->indexUrl = $path;
    }

    public function getIndex(){
        return $this->indexUrl;
    }
}

$bootstrap = new Bootstrap;
