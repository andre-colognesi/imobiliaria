<?php

function pp($var){
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
}

function _get($type,$var,$key = false){
    if(strtoupper($type) == "G"){
        if(isset($_GET[$var])){
            if($key){
                return key($_GET[$var]) . "=" . $_GET[$var];
            }
            return $_GET[$var];
        }
            return false;
    }

    if(strtoupper($type) == "P"){
        if(isset($_POST[$var])){
            if($key){
                return key($_POST[$var]) . "=" . $_POST[$var];
            }
            return $_POST[$var];
        }
            return false;
    }
}

function renderInputText($name,string $value = null,$label,array $attrs = null,$id = false){
    if(!$value){
        $value = _get("g",$name);
    }
    if($id){
        $id = 'id="'.$id.'"';
    }
    $attr = array();
    if($attrs){
        foreach($attrs as $key => $val){
            $attr[] = $key .'="'.$val.'"';
        }
    }  
    $input = '<label for="'.$name.'">'.$label.'</label>
    <input type="text" name="'.$name.'" '.$id.' value="'.$value.'" '.implode(" ",$attr) . "/>";
    echo $input;
}