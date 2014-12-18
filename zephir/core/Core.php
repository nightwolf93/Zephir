<?php

namespace Zephir\Core;

include_once 'Zephir/core/Autoloader.php';

class Core {

    public static $Instance;

    public $AppConfig;

    private $router;

    /**
     * Entry point of ZephirEasy
     */
    public function start(){
        define("PATH_Zephir", "Zephir/");
        define("PATH_CORE", PATH_Zephir . "core/");
        define("PATH_APP", PATH_Zephir . "app/");
        define("PATH_APP_MISC", PATH_APP . "/miscellaneous/");
        define("PATH_APP_MODULE", PATH_APP . "/modules/");

        self::$Instance = $this;

        $this->load();
        $this->initialize();
        $this->process();
    }

    /**
     * Load all components and libraries
     */
    public function load(){
        Autoloader::load("Zephir/core/");
        Autoloader::load("Zephir/app/controllers/");
        Autoloader::load("Zephir/app/models/");
        Autoloader::load("Zephir/app/modules/");
        Autoloader::load("Zephir/app/helpers/");
    }

    /**
     * Initialize all we need
     */
    public function initialize(){
        session_start();
        
        $this->initializeConfig();
        $this->initializeRouter();
        $this->initializeDatabase();
    }

    private function initializeConfig(){
        $this->appConfig = new Utils\YamlConfig(PATH_APP_MISC . 'app.yml');
        $this->appConfig = $this->appConfig->get();
    }

    private function initializeRouter(){
        $this->router = new Http\Router();
        $this->router->makeMapping();
    }

    private function initializeDatabase(){
        Database\Database::Setup();
    }

    /**
     * Redirect user to the route wished
     */
    private function process(){
        $this->router->follow();
    }
}
