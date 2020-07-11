<?php
namespace app\controller{
    use \app\model\Users as Users;
    use \app\config\session\Session as Session;
class LoginController extends Controller
{
    
    
    public function displayLogin(){
        $session = new Session();
        if($session->auth()){
            header("location: ".getenv("URL")."home");
        }
       $this->render('login');
    }

    public function login(){
        if(!Users::login($_POST)){
            header("location: ".getenv("URL")."login");
        }
        header("location: ".getenv("URL")."home");
    }

    public function displayRegister(){
        $session = new Session();
        if($session->auth()){
            header("location: ".getenv("URL")."home");
        }
        $this->render('register');
    }

    public function register(){
       $res =  Users::createUser($_POST);
       
        if(!$res){
            header("location: ".getenv('URL')."cadastrar-login");
        }
        
    }

    public function logout(){
        $this->startSession();
        $this->destroySession();
    }
}
}