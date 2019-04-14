#!/usr/bin/php
<?php
if (count($argv) == 4)
{
    $number1 = trim($argv[1]);
    $operator = trim($argv[2]);
    $number2 = trim($argv[3]);

    if ($operator == '+')
        $resultat = $number1 + $number2;
    else if ($operator == '-')
        $resultat = $number1 - $number2;
    else if ($operator == '*')
        $resultat = $number1 * $number2;
    else if ($operator == '/')
         $resultat = $number1 / $number2;
    else if ($operator == '%')
        $resultat = $number1 % $number2;
    echo $resultat."\n";
}
else
    echo "Incorrect Parameters\n";
?>