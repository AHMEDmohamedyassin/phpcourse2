<?php
require '../vendor/autoload.php';

use App\View;
use App\Router\Router;
use App\Controllers\HomeController;
use App\Controllers\FileController;

session_start();

define('STORAGE_PATH' , __DIR__ . '/../Storage');
define('VIEWS_PATH' , __DIR__ . '/../Views');

// echo '<pre>';
// print_r($_SERVER);
// print_r($_REQUEST);      // showing post and get request parameters
// print_r($_GET);          // showing get request parameters
// print_r($_POST);         // showing post request parameters
// echo '<pre/>';

try{
        $router = new Router();
        
        $router
        ->get('/' , [HomeController::class , 'index'])
        ->get('/create' , [HomeController::class , 'create'])
        ->post('/store' , [HomeController::class , 'store'])
        ->post('/store' , [HomeController::class , 'store'])
        ->get('/upload' , [FileController::class , 'upload'])
        ->get('/download' , [FileController::class , 'download'])
        ->post('/store/file' , [FileController::class , 'storeFile'])
        ->get('/add' , function () {
                echo 'add router';
        });
        
        $router->resolve($_SERVER['REQUEST_URI'] , $_SERVER['REQUEST_METHOD']);
}catch(\Exception $e){
        return View::make('404');
}