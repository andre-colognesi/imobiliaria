<?php
require "Database.php";
class User{
    private $table = 'users';
    private $pk = 'user_id';
    public function createUser(array $user)
    {
     $con = new Database();
     $sql = "INSERT INTO ".$this->table." (email,password,name,created_at,active) VALUES(:email,:password,:name,now(),'yes')";
     $execute = $con->db->prepare($sql);
     $execute->execute(array(
         ":name" => $user['name'],
         ":password" => $user['password'],
         ":email" => $user['email'],
     ));
     if($execute->rowCount() > 0){
         return true;
     }   
     
     return false;
    }
}