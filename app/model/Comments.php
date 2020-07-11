<?php
    namespace app\model{
    use \app\config\database\Database as DB;
    use \app\web\Request as Request;
    use \app\web\File as File;
    class Comments extends Model{
        protected $primaryKey = 'comment_id';
        protected $table = 'comments';
        
        public function createComment($comment){
            $data = array(
                "movie_id" => $comment['movie_id'],
                "comment" => $comment['comment'],
                );
            if($this->insert($data)){
                return true;
            }
            return false;
            
        }
        
        public function getMovieComments($id){
            $db = DB::init();
            $query = ' c.comment_id,c.comment,u.name,c.created_at';
            $join = "comments c inner join users u on c.created_by = u.user_id";
            $response = $db->select([$query],$join)->where("c.movie_id","=",$id)->fetchQuery();
            return $response;
        }
        
        public function replyComment($id){
            $reply = $_POST['reply'];
            $query = "INSERT INTO comments_reply (comment_id,reply,created_by,created_at) VALUES(".$id.",'".$reply."',".$_SESSION['USER_ID'].",now())";
            $res = $this->raw($query);
            if($res){
                return true;
            }
            return false;
        }
    
    }
    }