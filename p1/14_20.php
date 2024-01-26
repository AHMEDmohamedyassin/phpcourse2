<?php

$y = $x ?? 'hello '; // $y = "hello"; if $x is not defined

echo $y . '<br/>';


//*/ match expression similar to swich case
$variable  = 4;
$matchexp = match($variable){
    1 => "the one",
    2,3 => "2 or 3",
    default => "default value"
};

echo $matchexp;