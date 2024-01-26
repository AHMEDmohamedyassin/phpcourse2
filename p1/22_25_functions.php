<?php

// functions 

$x = 2220;

function A ( ...$numbers){
    return array_sum($numbers);
}

function B (int $x , int|float $y){
    echo 'global variable is : ' . $GLOBALS['x'] . ' local variabe is : ' . $x . '<br/> ';
    return $x / $y;
}

$nums = [1,2,4,5,6];

echo 'the array sum is : ' .  A(...$nums) . '<br/>';

echo 'the array division is : ' .  B(y:2 , x:10) . '<br/>';



// * / anonymous functions lambda function 
 
$lambda = function () use(&$x) {    // use($x)     to be abe to use global variable scope    use($x)     to be abe to use and update on global variable scope
    $x = $x * 2;
    return $x . '<br/>';
};

echo $lambda() . ' the global $x is : ' . $x . '<br/>';

$nums = [1,2,3,4,5];
function nums_map ($e) {return $e + 2; } 

echo '<pre>';
print_r($nums);
print_r( array_map(function($e) {return $e + 2; } , $nums) );    // lambda function
print_r( array_map('nums_map' , $nums) );                        // callback function
print_r( array_map(fn($e) => $e + 3 , $nums) );                  // arrow function
echo '<pre/>';

// multiline arrow function

$F = fn() => [
    print($x . "<br/>") ,
    print($x + 1 . "<br/>")
];

$F();

// single line arrow function

$F = fn() =>  "hello";

echo $F();