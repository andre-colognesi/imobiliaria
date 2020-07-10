<?php
class Database{
    private $host;
    private $database;
    private $pass;
    private $user;
    private $error = false;
    public $message;
    public $db;
    public function __construct()
    {
        
        $this->host = "localhost";
        $this->database = "real_state_db";
        $this->pass = "";
        $this->user = "root";
        $conn = $this->_connect();
        if($conn){
            $this->db = $conn;
            return true;
        }
  
        echo $this->message;
        die;
    }

    public function getDatabaseName(){
        return $this->database;
    }


    private function _connect(){
        try{
        $conn = new \PDO('mysql:host='.$this->host.';dbname='.$this->database.'', $this->user, $this->pass);
        $this->message = "Conectado com sucesso";
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        return $conn;
        }catch(Exception $e){
            $this->error = true;
            $this->message = "Ocorreu um erro: ".$e->getMessage();
            return false;
        }
    }
}