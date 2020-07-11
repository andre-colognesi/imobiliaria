<?php
    namespace app\model{
    use \app\config\database\Database as DB;
    use \app\web\Request as Request;
    use \app\web\File as File;
    class Movies extends Model{
        protected $primaryKey = 'movie_id';
        protected $table = 'movies';
    
        public function getAllMovies(){
            $db = DB::init();
            $response = $db->select(['*'],$this->table)->where('active','=',"'yes'")->fetchQuery();
            return $response;
        }
        
        public function createMovie(array $movie){
            if(!is_array($movie) || !$movie){
                return false;
            }
            $image = null;
            $json = array(
                "year" => $movie['year'],
                "director" => utf8_encode($movie['director'])
            );
            $data = array(
                "name" => $movie['name'],
                "rating" => $movie['rating'],
                "informations" => json_encode($json),
            );
            if($this->insert($data)){
                $id = $this->getId();
                //salva imagem
                if(isset($movie['image'])){
                $file = new File($movie['image']);
                $file->setPath('images/movies/'.$id);
                $file->setName(bin2hex(random_bytes(64)).'-'.$id);
            if($file->save()){
                $image = $file->getName().'.'.$file->getExtension();
                if($this->update($id,array("image"=>$image))){
                    return true;
                };
            }else{
            Session::addMsg('Erro ao inserir imagem','danger');
            }
            }
                
                return true;
            }
            return false;

        }
    
    }
    }