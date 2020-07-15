<?php
namespace app\controller{
    use app\model\Propertie as Propertie;
    use app\config\session\Session as Session;
    use ReflectionClass;

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
        $this->title = 'Todos os Imóveis';
        $propertie = new Propertie();
        $where = array();
        $this->filter("propertie_id","=");
        $this->filter("propertie_street","like",true);
        $list = $propertie->simpleList($this->filter);
        $this->render('imoveis/imoveis-list',compact('list'));
    }

    public function getPropertie($id){
        $Propertie = new Propertie();
        $this->title = 'Editar Imóvel ' . $id[0];
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

    public function factory(){
        for($i = 0; $i <= 150; $i++){
            $data['propertie_neighborhood'] = "Bairro teste ".$i;
            $data['propertie_street'] = 'Rua teste '.$i;
            $data['propertie_zip_code'] = $i;
            $data['propertie_number'] = $i;
            $data['propertie_state'] = "estado teste ".$i;
            $propertie = new Propertie();
            if($propertie->insert($data)){
                continue;
            }
            if($i == 150){
                exit;
            }
        }
        Session::addMsg('Foram inseridos '.$i.' proprierdades','success');
        $this->redirectBack();
    }


}
}