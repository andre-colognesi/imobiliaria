<?php
class Autoload{
 public static function loader($class)
 {
     $filename = $class . '.php';
     $file =  PATH.DS.str_replace("\\",DS,$filename);

    
     if (!file_exists($file))
     {
         return false;
     }
     include_once $file;
 }

}