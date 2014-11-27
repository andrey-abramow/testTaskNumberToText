<?php
require_once 'File.php';
abstract class Converter{
    protected $_dictionary;
    protected $_language;


    public  function __construct(){
        $this->setDictionaryFromJsonFile('dictionary/'.$this->_language.'.json');

     }
    private function setDictionaryFromJsonFile($filename){
        $file = new File($filename);
        $contents = $file->getContent();
        $arr = json_decode($contents);
        foreach($arr[0] as $key=>$value){
            $this->_dictionary[$key] = $value;
        }
        $this->getOtherSettings($arr);
    }
    abstract  protected function getOtherSettings($arr);

    public function convertNumberToText($number)
    {

        if(!is_numeric($number))
            throw new Exception("It is not a number!");
        if($number>=1000000000 || $number<=-1000000000)
            throw new Exception("The number cannot be more(less) then  +(-)999 999 999!");

        if ($number < 0) {
            return $this->_negative . $this->convertNumberToText(abs($number));
        }

        if ($number < 0) {
            return $this->_negative . $this->convertNumberToText(abs($number));
        }

        $_text = null;

        switch (true) {
            case $number < 21:
                $_text = $this->_dictionary[$number];
                break;
            case $number < 100:
                $tens   = ((int) ($number / 10)) * 10;
                $units  = $number % 10;
                $_text = $this->_dictionary[$tens];
                if ($units) {
                    $_text .= $this->_hyphen . $this->_dictionary[$units];
                }
                break;
            case $number < 1000:
                $_text = $this->lowerThen1000($number,$_text);
                break;
            default:
                $_text = $this->moreThen1000($number,$_text);

                break;
        }

        return $_text;

    }
   abstract  protected function lowerThen1000($number,$_text);
   abstract  protected function moreThen1000($number,$_text);

}