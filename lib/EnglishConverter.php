<?php
require_once 'Converter.php';
class EnglishConverter extends  Converter{
    protected $_language    = "English";
    protected $_hyphen      = '-';
    protected $_conjunction = ' and ';
    protected $_separator   = ', ';
    protected $_negative    = 'negative ';


    protected function lowerThen1000($number, $_text)
    {
        $hundreds  = $number / 100;
        $remainder = $number % 100;

        $_text = $this->_dictionary[$hundreds] . ' ' . $this->_dictionary[100];


        if ($remainder) {
            $_text .= $this->_conjunction . $this->convertNumberToText($remainder);

        }
        return $_text;
    }

    protected function moreThen1000($number, $text)
    {
        $baseUnit = pow(1000, floor(log($number, 1000)));
        $numBaseUnits = (int) ($number / $baseUnit);
        $remainder = $number % $baseUnit;
        $_text = $this->convertNumberToText($numBaseUnits) . ' ' . $this->_dictionary[$baseUnit];

        if ($remainder) {
            $_text .= $remainder < 100 ? $this->_conjunction : $this->_separator;
            $_text .= $this->convertNumberToText($remainder);

        }
        return $_text;
    }

    protected function getOtherSettings($arr)
    {
        //do nothing
    }
}