<?php
namespace app\controller{
    use  \app\config\session\Session as Session;
    class Controller extends Session{
        public $auth;
        public $dataUrl = array();
        public $breadcrumbs = [];
        public $title;
        public $pages;
        public $filter = array();
       
        public static $in = "IN";
        public static $like = "LIKE";

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

        public function redirectBack(){
            header("location: ".$_SERVER['HTTP_REFERER']);
        }

        public function render($file,$arr = null,$isView = true){
            $view = PATH.DS.'app'.DS.'view'.DS.$file.'.php';
            if(file_exists($view)){
                if(isset($arr)){
                    extract($arr);
                }
                if($isView){
                include_once PATH.DS.'app'.DS.'view'.DS."header.php";
                }
                include_once $view;
                if($isView){
                include_once PATH.DS.'app'.DS.'view'.DS."footer.php";
                }
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

        public function pages(){
            $pages = $_SESSION['pages'];
            if(!empty($pages) && $pages > 0){
                $url = explode("?",getenv("FULLURL"));
                $page = 1;
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
                $params = '';
                if(isset($_GET)){
                    unset($_GET['page']);
                    foreach($_GET as $k => $v){
                        $params  .= "&". $k."=".$v;
                    }
                };
                $page == 1 ? $disabledPrev = "disabled" : $disabledPrev = '';
                $page == $pages ? $disabledNext = "disabled" : $disabledNext = '';
                $firstPage = $page == 1 ? "disabled" : "";
                $lastPage = $page == $pages ? "disabled" : "";
                $pagination = 
                
                '<hr>
                <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center pagination-sm">
                <li class="page-item '.$firstPage.'">
                    <a class="page-link" href="'.$url[0].'?page=1'.$params.'"><small>primeira</small></a>
                </li>
                  <li class="page-item '.$disabledPrev.'">
                    <a class="page-link" href="'.$url[0].'?page='.($page-1) . $params.'" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                      <span class="sr-only"><small>Voltar</small></span>
                    </a>
                  </li>
                  ';
                  $active = '';
                  for($i = 1; $i <= $pages; $i++){
                      $i == $page ? $active = " active" : $active = '';
                      $pagination = $pagination . '<li class="page-item '.$active.'"><a class="page-link" href="'.$url[0].'?page='.$i.$params.'"><small>'.$i.'</small></a></li>';
                  };
                 $pagination = $pagination . '
                  <li class="page-item '.$disabledNext.'">
                    <a class="page-link" href="'.$url[0].'?page='.($page + 1) . $params;
                        $pagination.=
                    '" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                      <span class="sr-only"><small>Proximo</small></span>
                    </a>
                    <li class="page-item '.$lastPage.'">
                    <a class="page-link" href="'.$url[0].'?page='.$pages.$params.'"><small>Ultima</small></a>
                </li>
                  </li>
                </ul>
              </nav>'; 

              echo $pagination;
            }
        }

        public function filter($name,$type,$isString = false){
            $val = _get("g",$name);
            if($val){
                if(strtoupper($type) == self::$like){
                    $val = "%".$val."%";
                }
                if($isString){
                    $val = "'".$val."'";
                }

                if(strtoupper($type) == self::$in){
                    $val = "(".$val.")";
                }
                
            $this->filter[] = array(
                $name, $type, $val
            );
            }
        }

    }

}