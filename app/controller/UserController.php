<?php
namespace app\controller{
    use \app\config\session\Session as Session;
    use \app\web\Request as Request;
    use \app\web\File as File;
    use \app\model\Users as Users;
    class UserController extends Controller
{
    public function __CONSTRUCT(){
    
        $this->startSession();
        parent::__construct();
    }

    public function userConfig(){
        $this->addBread("Configurações","");
        $user = new Users($_SESSION["USER_ID"]);
        $user = $user->getConfig();
        $this->render("user/settings",compact('user'));

    }

    public function updateUser(){
        $user = new Users();

        if($_FILES['avatar']['tmp_name'] != "" && !empty($_FILES['avatar']['tmp_name'])){
        $file = new File($_FILES['avatar']);
        $oldFile = false;
        if(isset($_SESSION['AVATAR'])){
        $oldFile = $_SESSION['AVATAR'];
        }
      
        $file->setPath('images/avatar/'.$_SESSION['USER_ID']);
        $file->setName(bin2hex(random_bytes(64)).'-'.$_SESSION['USER_ID']);
        if($file->save()){
            if($oldFile){
            $file->deleteFile($file->getPath().'/'.$oldFile);
            }
        }
            $avatar = $file->getName().'.'.$file->getExtension();
        }else{
            $avatar = $_SESSION['AVATAR'];
        }
        if(!$user->updateSettings($_SESSION['USER_ID'],new Request($_POST),$avatar)){
            Session::addMsg('Ocorreu um erro!','warning');
        };
            Session::addMsg("Dados alterados com sucesso","success");
            $this->redirect("configuracao");
    }
}
}