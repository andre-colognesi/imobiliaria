<?php
namespace app\model{
    include_once 'app/Bootstrap.php';
    
    use \app\config\database\Database as DB;
    use \app\config\session\Session as Session;
    use \app\web\Request as Request;
    class Users extends Model{
        protected $primaryKey = 'user_id';
        protected $table = 'users';
        
        public function insert(array $data){
            $db = new \app\config\database\Database();
            $db = $db->connect();
            $columns = [];
            $params = [];
            $execute = [];
            $values  = [];
            $i = 0;
            foreach($data as $k => $v){
                $columns[] = $k;
                $params[] =   (string)':'.$k;
                $values[$k] = $v;
                $i++;
            }
           
            $query = "INSERT INTO ".$this->table."(".join(",",$columns) . ") VALUES (".join(",",$params).")";
            $insert = $db->prepare($query);
            $insert->execute($values);
            if($insert->rowCount() == 1){
                return true;
            }
                return false;
            
        }


        public static function createUser($params){
            $self = new self;
            $connection = new DB();
            $db = $connection->connect();            
            $select = $db->prepare("SELECT email FROM users WHERE email = :email");
                 $select->execute([":email" => $params['email']]);
            if($select->rowcount() > 0){
                Session::addMsg('Já existe um usúario cadastrado com esse email.','warning');
                return false;
            }
            
            $insert = array(
                'name'  => $params['name'],
                'email' => $params['email'],
                'password' => password_hash($params['password'],PASSWORD_BCRYPT)
             );
            $query = $self->insert($insert);
            if(!$query){
                Session::addMsg('Ocorreu um erro.','warning');
                return false;
            }
            $select = $db->prepare("SELECT * FROM users WHERE email = :email");
            
            $select->execute(array(
                ":email" => $params['email'],
                ));
            if($select->rowCount() == 0){
                return false;
            }
            $user = $select->fetch();
                $session = new Session();
                $session->initSession($user);
                return true;

        }

        public function updateSettings($id, Request $request, $fileName){
            $data = array(
                "name"  => $request->name,
                "email" => $request->email,
            );
            if(!$this->update($id,$data)){
                return false;
            }
            $_SESSION['AVATAR'] = $fileName;
            return true;
            

        }

        public static function login($params){
            $db = DB::connect();
        //   $db = $connection->connect();
            $query = $db->prepare("SELECT user_id, name, email, password from users where email = :email ");
            $query->execute(array(
                ':email' => $params['email'],            ));
            if($query->rowCount() == 1){
                $res = $query->fetch();
                if(password_verify($params['password'],$res['password'])){
                $session = new Session();
                Session::addMsg('Logado com sucesso!','success');
                $session->initSession($res);
                return true;
                }
            }
            Session::addMsg('Usuario ou senha invalidos.','warning');
            return false;                
        }
    }
}