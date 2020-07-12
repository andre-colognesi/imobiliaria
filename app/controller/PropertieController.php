<?php
namespace app\controller{
    use app\model\Propertie as Propertie;
    use app\config\session\Session as Session;
    class PropertieController extends Controller
{

    public function __CONSTRUCT(){
        $this->startSession();
        parent::__construct();
        $this->addBread('Imóveis',"imoveis");
    }

    public function createForm(){
        $this->addBread('Adicionar Imóvel',"");
        $this->title = 'Adicionar Imóvel';
        $this->render('imoveis/imoveis-form');
    }

    public function addPropertie(){
        $propertie = new Propertie();
        if($propertie->insert($_POST)){
            Session::addMsg('Imóvel cadastrado com sucesso','success');
            $this->redirect('imoveis');
            return true;
        }
            Session::addMsg('Ocorreu um erro ao cadastrar o imóvel','danger');
            $this->redirect('imovel/novo');
            return false;
        ;
    }

    public function allProperties(){
        $propertie = new Propertie();
        print_p($propertie->simpleList());

        $this->render('imoveis/imoveis-list',compact('list'));
    }

    public function getPropertie($id){
        $Propertie = new Propertie();
        $propertie = $Propertie->read($id[0]);
        $this->addBread('Editar Imovel '.$id[0],"");
        $this->render('imoveis/imoveis-form-update',compact('propertie'));


    }

    public function updatePropertie($id){
        $propertie = new Propertie();
        if($propertie->update($id[0],$_POST)){
            Session::addMsg('Imóvel atualizado com sucesso','success');
            $this->redirect('imoveis');
            return true;
        }
            Session::addMsg('Ocorreu um erro ao atualizar','danger');
            header('location: '.$_SERVER['HTTP_REFERER']);
            return false;


    }


}
}