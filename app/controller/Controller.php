<?php
namespace app\controller{
    use  \app\config\session\Session as Session;
    class Controller extends Session{
        public $auth;
        public $dataUrl = array();
        public $breadcrumbs = [];
        public $title;

        public function __CONSTRUCT(){
            $this->breadcrumbs[] = array(
                "title"  => "Home",
                "url"    => getenv("URL")."home"   
            );
            $url = explode("/",$_SERVER['REQUEST_URI']);
            $i = 0;
      
            foreach($url as $key => $value){
                if(preg_match("/[0-9]/",$value)){
                $this->dataUrl[$url[$i-1]] = $value;
                }
                $i++;
            }
        }

        public function getToken(){
            $token = "<input type=\"hidden\" name=\"request_token\" value=\"".$_SESSION['REQUEST_TOKEN']."\" />";
            echo $token;
        }

        public function redirect($url){
            header("location: ".getenv("URL").$url);
        }

        public function render($file,$arr = null){
            $view = PATH.DS.'app'.DS.'view'.DS.$file.'.php';
            if(file_exists($view)){
                if(isset($arr)){
                    extract($arr);
                }
                include_once PATH.DS.'app'.DS.'view'.DS."header.php";
                include_once $view;
                include_once PATH.DS.'app'.DS.'view'.DS."footer.php";
            }
        }      
        
        public  function addBread(string $title = null, string $url = null){
                $url = getenv("URL").$url;
                $this->breadcrumbs[] = array(
                "url" => $url,
                "title" => $title
            );
        }

        public function include($file){
            $path = PATH.DS.'app'.DS.'view'.DS.$file.'.php';
            if(file_exists($path)){
                include_once $path;
            }
        }

        public function responseJson(array $array, $status = 200){
            header('Content-Type: application/json');
            if(!\is_array($array)){
                $type = gettype($array);
                http_response_code(500);
                throw new \Exception("Error! array expected, {$type} given", 1);
            }
            $json = \json_encode($array);
                http_response_code($status);
                echo $json;

        }

        public function paginate($array){
            $pages = $array[0]->pages;
            if(!empty($pages) && $pages > 0){
                $url = explode("?",getenv("FULLURL"));
                $page = 1;
                $prev;
                $next;
                if(isset($_GET['page']) && !empty($_GET['page'])){
                    $page   = filter_var($_GET['page'],FILTER_VALIDATE_INT);
                    $page   = filter_var($page,FILTER_VALIDATE_INT);
                }
                if(empty($page) || $page == ""){
                    $page = 1;
                }
                if($page > $pages){
                    $page = $pages;
                }
                $page == 1 ? $disabledPrev = "disabled" : $disabledPrev = '';
                $page == $pages ? $disabledNext = "disabled" : $disabledNext = '';
                $pagination = 
                '<nav aria-label="Page navigation">
                <ul class="pagination">
                  <li class="page-item '.$disabledPrev.'">
                    <a class="page-link" href="'.$url[0].'?page='.($page-1) .'" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                      <span class="sr-only">Voltar</span>
                    </a>
                  </li>
                  ';
                  $active = '';
                  for($i = 1; $i <= $pages; $i++){
                      $i == $page ? $active = " active" : $active = '';
                      $pagination = $pagination . '<li class="page-item '.$active.'"><a class="page-link" href="'.$url[0].'?page='.$i.'">'.$i.'</a></li>';
                  };
                 $pagination = $pagination . '
                  <li class="page-item '.$disabledNext.'">
                    <a class="page-link" href="'.$url[0].'?page='.($page + 1).'" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                      <span class="sr-only">Proximo</span>
                    </a>
                  </li>
                </ul>
              </nav>'; 

              echo $pagination;
            }
        }
    }

}