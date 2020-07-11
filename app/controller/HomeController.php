<?php
namespace app\controller{

    class HomeController extends Controller
{

    public function __CONSTRUCT(){
        $this->startSession();
        parent::__construct();
    }

    public function home(){
       $this->render('home_view');
    }

}
}