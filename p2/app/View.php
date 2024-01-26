<?php

namespace App;


class View{
    protected string $path;
    protected array $params;

    public function __construct(string $path , array $params = []){
        $this->path = VIEWS_PATH . '/' . $path . '.php';
        $this->params = $params;
    }

    public static function make(string $path , array $params = []){
        return (new static($path , $params))->render();
    }

    public function render(){
        if(file_exists($this->path)){

            // method 1 // creating variables
            // foreach($this->params as $key => $val){
            //     $$key = $val; 
            // }

            // method 2 // creating variables
            extract($this->params );

            ob_start();
            include_once $this->path;
            $html = ob_get_clean();

            echo $html;
        }else {
            throw new \Exception('view not found');
        }
    }

    // public function __toString():string
    // {
    //     return (string) $this->render();
    // }
}