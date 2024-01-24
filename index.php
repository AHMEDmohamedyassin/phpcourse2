<?php

echo 'hello to phpcourse.io' . '<br/>';

echo $_SERVER['REQUEST_URI'] . '<br/>';

$files = array_filter(scandir('./') , fn($e) => str_contains($e , '.php'));
$files = scandir('./');

if(in_array(substr($_SERVER['REQUEST_URI'] , 1) . '.php' , $files)){
    require_once substr($_SERVER['REQUEST_URI'] , 1) . '.php';
}
