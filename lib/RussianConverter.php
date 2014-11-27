<?php
class RussianConverter extends Converter{

    protected $_language    = "Russian";

    private   $_thousand;
    private   $_millions;

    protected $_conjunction = ' ';
    protected $_separator   = ' ';
    protected $_hyphen      = ' ';
    protected $_negative    = 'минус ';

    protected function lowerThen1000($number, $_text)
    {
        $hundreds  = $number  - $number % 100;
        $remainder = $number % 100;
        $_text = $this->_dictionary[$hundreds];
        if ($remainder) {
            $_text .= $this->_conjunction . $this->convertNumberToText($remainder);
        }
        return $_text;
    }

    protected function moreThen1000($number, $_text)
    {
        $baseUnit = pow(1000, floor(log($number, 1000)));
        $numBaseUnits = (int) ($number / $baseUnit);
        $remainder = $number % $baseUnit;

        if($remainder<1000)
             $_text = $this->convertNumberToText($numBaseUnits) . ' ' . $this->_thousand[$this->changeEnding($numBaseUnits)];
        if($remainder>1000)
            $_text = $this->convertNumberToText($numBaseUnits) . ' ' . $this->_millions[$this->changeEnding($numBaseUnits)];

        if($baseUnit == 1000 && $numBaseUnits == 2){
            $_text = 'две' . ' ' . $this->_thousand[$this->changeEnding($numBaseUnits)];

        }
        if($baseUnit == 1000 && $numBaseUnits == 1){
            $_text = 'одна' . ' ' . $this->_thousand[$this->changeEnding($numBaseUnits)];

        }
        if ($remainder) {
            $_text .= $remainder < 100 ? $this->_conjunction : $this->_separator;
            $_text .= $this->convertNumberToText($remainder);
        }
        return $_text;
    }
    private function changeEnding($number){
        $n100 = $number % 100;
        $n10 = $number % 10;
        if( ($n100 > 10) && ($n100 < 20) ) {
            return 5;
        }
        elseif( $n10 == 1) {
            return 1;
        }
        elseif( ($n10 >= 2) && ($n10 <= 4) ) {
            return 2;
        }
        else {
            return 5;
        }
    }


    protected function getOtherSettings($arr)
    {
        foreach($arr[1] as $key=>$value){
            $this->_thousand[$key] = $value;
        }
        foreach($arr[2] as $key=>$value){
            $this->_millions[$key] = $value;
        }
    }
}