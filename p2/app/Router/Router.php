<?php

namespace App\Router;


class Router{
    
    protected array $routes = [];

    public function Register(string $method , string $route , callable|array $action):self {
        $this->routes[$method][$route] = $action;
        return $this;
    }

    public function get(string $route , callable|array $action):self {
        $this->Register('GET' , $route , $action);
        return $this;
    }

    public function post(string $route , callable|array $action):self {
        $this->Register('POST' , $route , $action);
        return $this;
    }

    public function resolve(string $REQUEST_URI , string $method){
        $route = explode('?' , $REQUEST_URI)[0];
        $action = $this->routes[$method][$route] ?? null;

        if(!$action)
            throw new \Exception('404 route not found');
        
        if(is_callable($action))
        return call_user_func($action);
    
        if(is_array($action)){
            [$class , $method] = $action;

            if(class_exists($class)){
                $class = new $class;

                if(method_exists($class , $method)){
                    return call_user_func_array([$class , $method] , []);
                }
            }

        }
    
    throw new \Exception('404 route not found');
}

}