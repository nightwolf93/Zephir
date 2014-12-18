<?php

namespace Zephir\Logic;

use Zephir\Core\Http\Session;

class Controller {
    
    public $layoutName;
    public $viewName;
    public $namespace;
    
    private $_session = null;
    
    public $parameters = array();
    
    public function setLayout($layoutName){
        $this->layoutName = $layoutName;      
    }
    
    public function setView($viewName){
        $this->viewName = $viewName;      
    }
    
    public function setNamespace($namespace){
        $this->namespace = $namespace;      
    }
    
    public function set($key, $value){
        $this->parameters[$key] = $value;
    }
    
    public function isAjax() {
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            return true;
        }
        else {
            return false;
        }
    }
    
    public function session(){
        if($this->_session == null){
            $this->_session = new Session();
        }
        return $this->_session;
    }
    
    public function ajax($data){
        echo json_encode($data);
        exit();
    }
    
    public function redirect($route){
        header("location: " . \Zephir\Core\Core::$Instance->appConfig['common']['absolute_path'] . $route);
        exit();
    }
}
