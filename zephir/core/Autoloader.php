<?php

namespace Zephir\Core;

class Autoloader {

    public static $included = array('Autoloader.php');
    
    public static function load($path){
        $dh  = opendir($path);
        while (false !== ($filename = readdir($dh))) {
            if($filename != '.' && $filename != '..'){
                if(!in_array($filename, self::$included)){
                    if(is_dir($path . $filename)){
                        if($filename !== 'views'){
                            self::load($path . $filename . '/');
                        }
                    }
                    else{
                        $ext = pathinfo($path . $filename, PATHINFO_EXTENSION);
                        if($ext === 'php'){
                            include_once $path . $filename;
                        }            
                    }
                }        
            }         
        }
    }
}