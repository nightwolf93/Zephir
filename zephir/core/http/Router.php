<?php

namespace Zephir\Core\Http;

class Router {

    private $router;
    private $routesConfig;

    public function __construct(){
        $this->router = new \AltoRouter();
        $this->router->setBasePath(\Zephir\Core\Core::$Instance->appConfig['common']['base_path']);
        $this->routesConfig = new \Zephir\Core\Utils\YamlConfig(PATH_APP_MISC . 'routes.yml');
    }

    public function makeMapping(){
        $data = $this->routesConfig->get();
        foreach($data['routes'] as $properties){
            $keys = array_keys($properties);
            $key = $keys[0];
            $values = array_values($properties);
            $properties = $values[0];
            $this->router->map($properties['method'], $key, array('c' => $properties['controller'], 'a' => $properties['action']));
        }
    }

    public function follow(){
        $match = $this->router->match();
        if($match){
            $controllerClass = new \ReflectionClass('\Zephir\App\Controllers\\' . $match['target']['c'] . '\\' . $match['target']['c'] . 'Controller');
            $controller = $controllerClass->newInstanceArgs();
            $controller->setLayout('common.layout');
            $controller->setNamespace(strtolower($match['target']['c']));
            $controller->setView(strtolower($match['target']['a']));
            $controller->$match['target']['a']($match['params']);

            $this->renderView($controller);
        }
        else{
            //TODO: 404
            echo "<center>The route don't match with any routes in routes.yml, check your file or your url<br />Zephir Framework</center>";
        }
    }

    public function renderView($controller){
        $view = new \Zephir\Logic\View();
        $view->render($controller);
    }
}
