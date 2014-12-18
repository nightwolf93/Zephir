<?php

namespace Zephir\Core\Database;

class Database {
    
    private static $config;
    private static $used;
    private static $link;
    
    public static function Setup(){
        self::$config = \Zephir\Core\Core::$Instance->appConfig['databases'];
        self::$used = self::$config['definitions'][0][self::$config['use']];
        
        self::$link = new \medoo([
                'database_type' => self::$used['type'],
                'database_name' => self::$used['db'],
                'server' => self::$used['host'],
                'username' => self::$used['username'],
                'password' => self::$used['password'],
        ]);
    }
    
    public static function getLink(){
        return self::$link;
    }
}
