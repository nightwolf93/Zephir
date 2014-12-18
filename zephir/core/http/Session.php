<?php

namespace Zephir\Core\Http;

class Session {
    
    public $controller;
    
    public function Session($controller){
        $this->controller = $controller;
    }
    
    public function get($key){
        return $_SESSION[$key];
    }
    
    public function set($key, $value){
        $_SESSION[$key] = $value;
    }
    
    public function getFlash($key){
        if($this->exist($key)){
            $value = $_SESSION[$key];
            unset($_SESSION[$key]);
        }
        else {
            $value = null;
        }   
        return $value;
    }
    
    public function exist($key){
        echo $key;
        return isset($_SESSION[$key]);
    }
}