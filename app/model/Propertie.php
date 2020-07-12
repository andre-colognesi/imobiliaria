<?php


namespace app\model{
    use \app\config\database\Database as DB;
    use \app\web\Request as Request;
    use \app\web\File as File;
    use \app\config\Session as Session;
    class Propertie extends Model{
        protected $primaryKey = 'propertie_id';
        protected $table = 'properties';

    }

}