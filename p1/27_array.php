<?php 

$arr = [1,2,3,4 , 5 , 5];
$arr2 = [6,5,64,2 , false , true];

echo '<pre>';

print_r( array_chunk($arr , 2) );          // split array into smaller arrays 

print_r( array_combine($arr , $arr2) );    // using first array as a __ KEYS __ and second array as a __ VALUES __ two arrays must have same size

$even = array_filter($arr , fn($e)=> $e % 2 == 0 );    // filter
print_r( $even ) ; 

$values = array_filter($arr2);
$values = array_values($values);
print_r($values);


$arr_map = array_map(fn($e , $e2) => $e + $e2 + 10 , $arr , $arr2);    // maping
// $arr_map = array_map(fn($e) => $e + 10 , $arr);
print_r($arr_map);


// $arr_merg = array_merge($arr , $arr2);        // merging
$arr_merg = [...$arr , ...$arr2];
print_r($arr_merg);


$arr_red = array_reduce($arr , fn($sum , $item) => $sum + $item);        // reduce
echo $arr_red . '<br/>';


$searching_key = array_search('5' , $arr);     // search     returns only first found item key if item not found return false
echo 'search item key : '  . $searching_key . ' , check if item found : ' . in_array(5 , $arr) . '<br/>';


// comparing arrays 
print_r( array_diff($arr  , $arr2 )) ; // comparing values
print_r( array_diff_key($arr  , $arr2 )) ; // comparing keys
print_r( array_diff_assoc($arr  , $arr2 )) ; // comparing values and keys

// sorting
ksort($arr2);
sort($arr); 
print_r($arr);

echo '<pre/>';