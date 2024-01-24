<?php

// بتعمل الزام بنوع المتغير 
declare(strict_types=1);

//*/ variable

$a = "first variable";

//*/ constant

define('the_const' , "  the constant variable");
const the_const_2 = "the const 2";    // can not be used in conditions if - else
$check_constant_defined = defined('the_const');

echo $a , the_const , $check_constant_defined;


//*/ variable variablle

$foo = "bar";
$$foo = "bar";   // $bar = "bar";

//*/ get variable type

echo "<br/>" . gettype($a) . "<br/>";
var_dump($a);

//*/ int floats

$integer = (int) 200_00; // $integer = 200_00;
$floating = (float) "2.344e2"; // $floating = 2.344e2;
// NAN  , INF -> infinity 
echo '<br/>' . $integer . "<br/>" . $floating . "<br/>";


//*/string

[$x , $y] = [1 , 2];
//Heredoc
$text = <<<TEXT
line 1 $x
line 2 $y
line 3
TEXT;

echo nl2br($text) . '<br/>';

//Nowdoc
$text = <<<TEXT
line 1 $x
line 2 $y
line 3
TEXT;

echo nl2br($text) . '<br/>';


//*/ Array
$arr = ['php' , 'java'];
echo "array count :" . count($arr) . '<br/>';
$arr[] = 'css';
array_push($arr , 'c++' , 'js');

echo 'check array key 3  exists : ' . array_key_exists(3 , $arr) . "<br/>";
if(isset($arr[1])) {
    echo '<pre>';
    print_r($arr);
    echo '<pre/>';
}