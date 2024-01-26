<?php

namespace App\Controllers;

use App\View;

class HomeController{
    public function index () {
        $_SESSION['count'] = ($_SESSION['count'] ?? 0) + 1 ;
        echo 'count session : '  . $_SESSION['count'] . '<br/> <pre>';

        setcookie('name' , 'ahmed' , time() + 10);

        var_dump($_COOKIE); 
        var_dump($_SESSION); // to show sessions
        
        return View::make('home');
    }

    public function create () {
        unset($_SESSION['count']);
        echo '<form action="/store" method="post"><label>enter your name : </label><input name="name" /></form>';
    }

    public function store(){
        echo '<pre> the post request parameters is : ';
        print_r($_POST);
        echo '</pre>';
    }
}