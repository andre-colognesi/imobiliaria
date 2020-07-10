<?php
require "BaseModel.php";

class RealEstate extends BaseModel{
    
    public function createRealEstate(array $data){
        $this->insert($data);
    }
}