<?php
namespace app\web{
    include_once PATH."/app/Bootstrap.php";
    use app\helper\Validator as Validator;
    class Request extends Validator{
        public $request;
        protected $url;

        public function __CONSTRUCT($request = null){
            if($request){
            try{
                if($_SERVER['REQUEST_METHOD'] != "GET"){
                $this->checkToken($request['request_token']);
                }   
            }catch(Exception $e){
                return $e->getMessage();
                }
            foreach($request as $index => $value){
                $this->{$index} = Validator::sanitazeInput($value);
                }
            }
        }

        public function show(){
            echo '<pre>';
            var_dump($this);
            echo '</pre>';
            die();
        }

        private function checkToken($token){
            if(!$token){
                throw new \Exception("Request ID Token Required. Not found");
                return false;
            }
  
            if($token != $_SESSION['REQUEST_TOKEN']){
                throw new \Exception("Request Token Dont Match");
                return false;
            }

            return true;
        }

        private function sanitazeUrl($url){
            $sanitazedUrl = \filter_var($url,FILTER_SANITIZE_URL);
            return $sanitazedUrl;
        }


        public function setUrl($url){
            $url = explode("?",$url);
            $this->url = $this->sanitazeUrl($url[0]);
        }

        public function getUrl(){
            return $this->url;
        }
    }
}