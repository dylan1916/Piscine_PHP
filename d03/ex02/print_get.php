<?php
$value = $_GET;
foreach($value as $key => $value)
{
    echo $key .": ". $value ."\n";
}
?>