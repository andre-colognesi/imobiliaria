<?php
require "Database.php";
class BaseModel{

    public function insert(array $data){
        $con = new Database();
        $sql = "INSERT INTO ".$this->table." (";
        $arrInsert = array();
        $arrExecute = array();
        $arrFinal = array();
        
        foreach($data as $key => $value){
            array_push($arrInsert,$key);
            array_push($arrExecute, ":".$key);
           $arrFinal[":".$key] = $value;
        }

        $stringInsert = implode(",",$arrInsert);
        $sql .= $stringInsert . ") VALUES(" . implode(',',$arrExecute) . ")"; 
        $execute = $con->db->prepare($sql);
        $execute->execute($arrFinal);
        if($execute->rowCount() == 1){
            return true;
        }
            return false;

    }

    public function selectAll($where = false)
    {
    $con = new Database();
    $sql = "SELECT * FROM " . $this->table;
    if($where && is_array($where)){
        $arrWhere = implode(" and ",$where);
        $sql .= " where " . $arrWhere;
    }

    $execute = $con->db->prepare($sql);
    $execute->execute();
    if($execute->rowCount() == 1){
        return $execute->fetch();
        
    }
    
    return false;

    }


}