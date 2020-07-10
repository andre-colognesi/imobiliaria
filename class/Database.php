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
        $this->db = $this->_connect();
    }

    private function _connect(){
        try{
        $conn = new \PDO('mysql:host='.$this->host.';dbname='.$this->database.'', $this->user, $this->pass);
        $this->message = "Conectado com sucesso";
        return $conn;
        }catch(Exception $e){
            $this->error = true;
            $this->message = "Ocorreu um erro: ".$e->getMessage();
            return false;
        }
    }
}