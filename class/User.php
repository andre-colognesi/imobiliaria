<?php
require "BaseModel.php";
class User extends BaseModel{
    public $table = 'users';
    public $pk = 'user_id';
    public function createUser(array $user)
    {

        if($this->insert($user)){
            return true;
        }

            return false;


    }

    public function login($arr){
        $where = array(
            0 => "email='".$arr['email']."'",
            1 => "password='".$arr['password']."'"
        );
         return $this->selectAll($where);
        
    }
    
    
}