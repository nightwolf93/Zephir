<?php

namespace Zephir\App\Modules;

class OfferModule {
    
    private static $offers = array(
        1 => array("id" => 1, "name" => "Gratuit", "price" => "0", "max-updates" => 5)
    );
    
    public static function getOffer($id){
        if(is_numeric($id)){
            if($id > 0 && $id <= count(self::$offers)){
                return self::$offers[$id];
            }
            else {
                return null;
            }
        }
        else {
            return null;
        }
    }
}