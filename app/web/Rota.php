<?php
namespace app\web{
include_once PATH."/app/Bootstrap.php";
class Rota
{
    private $_rotas = array();
    private $_urlParameters = array();
    public function addRota($method, $url, $controller){
        $this->_rotas[] = [
            'method'=>$method,
            'url'=>"/".$url,
            'controller'=>$controller
        ];
    } 

    public function showRota(){
        return $this->_rotas;
    }
    public function execRota($url){
        $url = $this->validUrl($url);
        //die($url);
        foreach($this->_rotas as $index)
        {
            if($index['url']."/" == $url || $index['url']."/" == $url."/"){
                if($index['method'] == $_SERVER['REQUEST_METHOD']){
                    $controllers = $index['controller'];
                    $controllers = explode("@",$controllers);
                    $controller = "app\\controller\\".$controllers[0];
                    $controller = new $controller;
                    $function = $controllers[1];
                    $controller->$function($this->getParam());
                    $this->clearParam();
                    return true;
                }else{
                    echo 'Método invalido';
                }
            }
            
        }
        $controller = "app\\controller\\RequestController";
        $controller = new $controller;
        $controller->notFound();
        return false;
    }
    private function getParam(){
        return $this->_urlParameters;
    }

    private function setParam($position,$param){
        $this->_urlParameters[$position] = (int) $param;
    }

    private function clearParam(){
        $this->_urlParameters = array();
    }

    private function validUrl($url){
            $i = 0;
            $j = 0;
            $url = explode("/",$url);
            foreach($url as $k => $v){
                if(preg_match("/[0-9]/",$v)){
                    $this->setParam($j,$v);
                    $url[$i] = "{id}";   
                    $j++;
                }
                $i++;
            }   

            $url = join("/",$url);
            return $url;
            
    }

}
}