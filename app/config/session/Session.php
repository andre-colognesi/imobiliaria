<?php
namespace app\config\session{
    include_once 'app/Bootstrap.php';
    class Session{
        
        public function __construct(){
           return session_start();
        }
        #inicio a sessão
        public function startSession(){
                if(!isset($_SESSION)){
                    session_start();
                    $this->checkSession();
            }
        }
        #checa se a sessão existe, caso contrário redireciona para o login;
        protected function checkSession(){
        if( !isset($_SESSION['USERNAME']) || !isset($_SESSION['ID']) || !isset($_SESSION['USER_ID']) || !isset($_SESSION['IP']) || !isset($_SERVER['REMOTE_ADDR']) || $_SESSION['AGENT'] != $_SERVER['HTTP_USER_AGENT']){
            header("location: ".getenv("URL")."login");
        }else{
            return true;
        }
    }
        #cria uma sessão;
       public function initSession(array $data){
            if(!isset($_SESSION)){
                session_start();
            }
                $this->addValue('USERNAME',$data['name']);
                $this->addValue('EMAIL',$data['email']);
                $this->addValue('USER_ID',$data['user_id']);
                $this->addValue('ID',session_id());
                $this->addValue('IP',$_SERVER['REMOTE_ADDR']);
                $this->addValue('AGENT',$_SERVER['HTTP_USER_AGENT']);
                $this->addValue('REQUEST_TOKEN',bin2hex(random_bytes(64)));
                $this->addValue('AVATAR',$data['avatar']);
                if($this->checkSession()){
                    if(isset($_COOKIE['REDIRECT_URL'])){
                     header('location:'.GETENV('URL').$_COOKIE['REDIRECT_URL']);
                      }else{    
                        header("location:".getenv('URL'). "home");
                        return true;
                }
                }
        }

        #autentica para if;
        public function auth(){
            if(isset($_SESSION)){
        if( !isset($_SESSION['USERNAME']) || !isset($_SESSION['ID']) || !isset($_SESSION['USER_ID']) || !isset($_SESSION['IP']) || !isset($_SERVER['REMOTE_ADDR']) || $_SESSION['AGENT'] != $_SERVER['HTTP_USER_AGENT']){
                    return false;
                }
                    return true;
            }
                return false;
        }

        public function addValue($index,$value){
                if(!isset($_SESSION)){
                    return false;
                }
                $_SESSION[$index] = $value;
        }

        public static function addMsg($msg,$type = null){
            if(!$type){
                $type = "warning";
            }
            if(!isset($_SESSION)){
                session_start();
            }
            $_SESSION['MESSAGE'] = ["TYPE" => $type, "MESSAGE" => $msg];
        }

        public static function displayMsg(){
            if(!isset($_SESSION)){
                session_start();
                if(isset($_SESSION['MESSAGE'])){
                    print "<div onclick='this.remove()' class='col-sm-12 alert alert-".$_SESSION["MESSAGE"]["TYPE"]." btn border-rounded' role='alert'>".$_SESSION['MESSAGE']["MESSAGE"]." <a data-dismiss='alert' role='button' class='close'>&times;</a></div> ";
                    unset($_SESSION['MESSAGE']);
                }
            }
        }

        public function destroySession(){
            if(isset($_SESSION)){
                session_unset();
                $this->checkSession();
            }
            if(isset($_COOKIE['REDIRECT_URL'])){
                setcookie('REDIRECT_URL',"",time()-3600,"/");
            }
                $this->checkSession();
            
        }
    }   


}






