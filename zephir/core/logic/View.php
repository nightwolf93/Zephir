<?php

namespace Zephir\Logic;

class View {

    private $data = array();
    private $controller;

    public function __get($varName){
        if(array_key_exists($varName, $this->data)){
            return $this->data[$varName];
        }
        else {
            return null;
        }
    }
    
    private function getHelpers(){
        return array(
                    'render' => function(){
                        return $this->renderView();
                    },
                            
                    'style' => function($cx, $args){
                        return '<link href="' . \Zephir\Core\Core::$Instance->appConfig['common']['absolute_path'] . '/zephir/public/css/' . $args['name'] . '.css" rel="stylesheet">';
                    },
                            
                    'script' => function($cx, $args){
                        return '<script src="' . \Zephir\Core\Core::$Instance->appConfig['common']['absolute_path'] . '/zephir/public/js/' . $args['name'] . '.js"></script>';
                    },
                    
                    'image' => function($cx, $args){
                        return '<img src="' . \Zephir\Core\Core::$Instance->appConfig['common']['absolute_path'] . '/zephir/public/images/' . $args['name'] . '" />';
                    },
                            
                    'captcha' => function($cx, $args){
                        return '<img id="' . $args['id'] . '" src="' . \Zephir\Core\Core::$Instance->appConfig['common']['absolute_path'] . '/security/captcha" />';
                    },
                            
                    'route' => function($cx, $args){
                        $url = \Zephir\Core\Core::$Instance->appConfig['common']['absolute_path'] . '/' . $args['to'];
                        if(array_key_exists("params", $args)){
                            $url .= '/' . $args['params'];
                        }
                        return $url;
                    },
                            
                    'template' => function($cx, $args){
                        return file_get_contents('zephir/app/templates/' . $args['name'] . '.hbs.html');
                    }
                );
    }
    
    private function getBlocksHelpers(){
        return array(

                );
    }

    public function __set($varName,$value){
        $this->data[$varName] = $value;
    }

    public function render($controller){
        $this->controller = $controller;
        foreach($this->controller->parameters as $k => $p){
            $this->__set($k, $p);
        }
        $filename = PATH_APP . 'views/layouts/' . $controller->layoutName;

        if(file_exists($filename . '.tpl')){
            //include $filename;
            $tpl = \LightnCandy::compile(file_get_contents($filename . '.tpl'), array(
                'flags' => \LightnCandy::FLAG_HANDLEBARS | \LightnCandy::FLAG_ERROR_LOG | \LightnCandy::FLAG_STANDALONE | \LightnCandy::FLAG_NOESCAPE,
                'helpers' => $this->getHelpers(),
                'blockhelpers' => $this->getBlocksHelpers()
            ));
            file_put_contents($filename . '.cache.php', $tpl);
            $renderer = include($filename . '.cache.php');
            echo $renderer($this->controller->parameters);
        }
        else {
            echo 'Layout not found, please create this file : ' . $filename;
        }
    }

    public function renderView(){
        $filename = PATH_APP . 'views/' . $this->controller->namespace . '/' . $this->controller->viewName;
        if(file_exists($filename . '.tpl')){
            //include $filename;
            $tpl = \LightnCandy::compile(file_get_contents($filename . '.tpl'), array(
                'flags' => \LightnCandy::FLAG_HANDLEBARS | \LightnCandy::FLAG_ERROR_LOG | \LightnCandy::FLAG_STANDALONE | \LightnCandy::FLAG_NOESCAPE,
                'helpers' => $this->getHelpers(),
                'blockhelpers' => $this->getBlocksHelpers()
            ));
            file_put_contents($filename . '.cache.php', $tpl);
            $renderer = include($filename . '.cache.php');
            return $renderer($this->controller->parameters);
        }
        else {
            echo 'View not found, please create this file : ' . $filename;
        }
    }
   
}
