<?php

namespace Zephir\Core\Utils;

class YamlConfig {
    
    private $path;
    private $data;
    
    public function __construct($path){
        $this->path = $path;
        $this->load();
    }
    
    private function load(){
        $this->data = \Spyc::YAMLLoad($this->path);
    }
    
    public function get(){
        return $this->data;
    }
}

class YamlNode {
    
}