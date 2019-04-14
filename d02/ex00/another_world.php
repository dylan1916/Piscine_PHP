#!/usr/bin/php
<?php
if ($argc > 1)
{
    $string = $argv[1];
    $string = preg_replace('/\s\s+/', ' ', $string);
    $string = trim($string);
    echo $string."\n";
}
?>