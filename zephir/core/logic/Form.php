<?php

namespace Zephir\Core\Logic;

class Form {
    
    protected $name;
    protected $template;
    protected $fields = array();
    protected $method = 'POST';
    
    public function __construct($name, $template) {
        $this->name = $name;
        $this->template = $template;
    }
    
    public function add($name, $type, $parameters = array()) {
        $this->fields[$name] = array('type' => $type, 'parameters' => $parameters);
        return $this;
    }
    
    public function begin(){
        return '<form id="' . $this->name . '" method="' . $this->method . '">';
    }
    
    public function end(){
        return '</form>';
    }
    
    public function get(){
        include PATH_APP . 'templates/forms/' . $this->template . '.form.php';
    }
    
    public function getField($name){
        $field = $this->fields[$name];
        $method = "getField" . ucfirst(strtolower($this->fields[$name]['type']));
        return $this->$method($name, $this->fields[$name]['parameters']);
    }
    
    private function getFieldText($name, $parameters){
        return '<input type="text" name="' . $name . '" id="' . $this->name . '_' . $name .  '" />';
    }
    
    private function getFieldPassword($name, $parameters){
        return '<input type="password" name="' . $name . '" id="' . $this->name . '_' . $name .  '" />';
    }
    
    private function getFieldSubmit($name, $parameters){
        return '<input type="submit" value="' . $parameters['value'] . '" />';
    }
    
    //TODO: Filters
}