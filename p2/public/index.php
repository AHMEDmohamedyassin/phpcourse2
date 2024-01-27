<?php
require '../vendor/autoload.php';

use App\Controllers\DBController;
use App\View;
use App\Router\Router;
use App\Controllers\HomeController;
use App\Controllers\FileController;

session_start();

define('STORAGE_PATH' , __DIR__ . '/../Storage');
define('VIEWS_PATH' , __DIR__ . '/../Views');

// // loading env file
$dotenv = Dotenv\Dotenv::createImmutable(dirname( __DIR__));
$dotenv->load();

// echo '<pre>';
// print_r($_SERVER);
// print_r($_REQUEST);      // showing post and get request parameters
// print_r($_GET);          // showing get request parameters
// print_r($_POST);         // showing post request parameters
// echo '<pre/>';

// phpinfo();

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
        })
        ->get('/db' , [DBController::class , 'index'])
        ->get('/db/insert' , [DBController::class , 'insert'])
        ->get('/db/get' , [DBController::class , 'get'])
        ->get('/db/update' , [DBController::class , 'update'])
        ->get('/db/delete' , [DBController::class , 'delete'])
        ->get('/db/droptable' , [DBController::class , 'droptable'])
        ->get('/db/rel/insert' , [DBController::class , 'relationInsert'])
        ->get('/db/rel/get' , [DBController::class , 'relationGet'])
        ->get('/db/transaction' , [DBController::class , 'transaction']);
        
        $router->resolve($_SERVER['REQUEST_URI'] , $_SERVER['REQUEST_METHOD']);
}catch(\Exception $e){
        return View::make('404');
}