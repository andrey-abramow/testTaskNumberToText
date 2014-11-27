<?php

require_once 'lib/ConverterFactory.php';
try {
    $converter = ConverterFactory::getConverter($argv[1]);
    echo $converter->convertNumberToText($argv[2]);
}
catch(Exception $e){echo $e->getMessage();}

/**
 *
 * -MacBook-Pro:test3 abramowandrey$ php index.php Russian 4566456
четыре миллиона пятьсот шестдесят шесть тысяч четыреста пятдесят шесть
 * Abramows-MacBook-Pro:test3 abramowandrey$ php index.php Ukraine -4566456
мінус чотири мільйона п'ятсот шістьдесят шість тисяч чотириста п'ятдесят шість
 * Abramows-MacBook-Pro:test3 abramowandrey$ php index.php English -4566456
negative four million, five hundred and sixty-six thousand, four hundred and fifty-six
  */


