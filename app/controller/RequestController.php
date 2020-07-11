<?php
namespace app\controller{

    class RequestController extends Controller
{

    public function __CONSTRUCT(){
        $this->startSession();
        parent::__construct();
        $this->addBread("Página não encontrada");
    }

    public function notFound(){
        
        $this->render("helper/404");
       
    }

}
}