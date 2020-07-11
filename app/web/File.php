<?php
namespace app\web{
    class File{
        protected $name;
        protected $type;
        protected $tmp;
        protected $size;
        protected $path;
        protected $extension;
        public function __construct($file){
            if(!is_uploaded_file($file['tmp_name'])){
                throw new \Exception("File is not uploaded by HTTP POST",2);
            }
            $this->name = $file['name'];
            $this->type = $file['type'];
            $this->tmp  = $file['tmp_name'];
            $this->size = $file['size'];
            $this->extension = \pathinfo($file['name'],PATHINFO_EXTENSION);
            $this->path = realpath('') . '/app/upload/';

        }

        public function setPath($path){
            $folder = $this->getPath();
            $folder = $folder . $path;
            if(!file_exists($folder)){
                mkdir($folder,0777,true);
            }
            $this->path = $folder;
        }

        public function getPath()
        {
            return $this->path;
        }

        public function setName($name){
            $this->name = $name;
        }

        public function getExtension(){
            return $this->extension;
        }

        public function getName(){
            return $this->name;
        }


        public function save(){
    
            if(!move_uploaded_file($this->tmp,$this->getPath().'/'.$this->name.'.'.$this->extension)){
                throw new \Exception("Error when uploading files", 1);  
            };
                return true;
        }

        public function deleteFile($filename){
            if(!unlink($filename)){
                throw new \Exception("Error deleting file", 1);
            };
                return true;
        }
        
    

    }
}