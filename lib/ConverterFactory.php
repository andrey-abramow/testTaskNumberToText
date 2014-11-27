<?php
require_once "EnglishConverter.php";
require_once "RussianConverter.php";
require_once "UkraineConverter.php";

class ConverterFactory {

    public static function getConverter($language){

            if($language == 'English')
               return new EnglishConverter();
        elseif($language == 'Russian')
               return new RussianConverter();
        elseif($language == 'Ukraine')
               return new UkraineConverter();

    }
}