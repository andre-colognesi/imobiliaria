<?php
namespace app\helper{
    include_once 'app/Bootstrap.php';
    class Validator{
        
        protected static function validateInt($input){
            $return =  preg_match("/^[1-9][0-9]$/",$input);
            if($return){
               return self::filterInt($input);

            }
            return $return;
        } 

        protected static function filterInt($int){
            $return = preg_replace("/[^0-9]/", "",$int);
            if($return == ""){
                $return = null;
            }

            return $return;
        }

        protected static function sanitazeInput($input){
            $validated =  filter_var($input,FILTER_SANITIZE_STRING);
            $validated = filter_var($validated,FILTER_SANITIZE_SPECIAL_CHARS);
            if($validated == ""){
                $validated = null;
            }
            $int = self::validateInt($validated);
            if($int){
                return $int;
            }
            return $validated;
        }
    }

}