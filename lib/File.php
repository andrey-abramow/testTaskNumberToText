<?php
class File {
    private  $_file;
    private  $_fileSize;
    public function __construct($filename){
        if(!file_exists($filename)) throw new Exception("file not found");
        $this->_file     = fopen($filename,"r");
        $this->_fileSize = filesize($filename);
    }
    public function getContent(){
        return fread($this->_file, $this->_fileSize);
    }
    public function closeFile(){
        fclose($this->_file);
    }
    public  function __destruct(){
        fclose($this->_file);
    }
}