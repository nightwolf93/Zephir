<?php

namespace Zephir\App\Modules;

class CaptchaModule {
    
    public static function buildCaptcha($word=null){
        if($word == null){
            $word = self::getRandomWord();
        }
        header("Content-type: image/png");
        $img = imagecreate(170, 40);
	$noir = imagecolorallocate($img, 0, 0, 0);
        $white = imagecolorallocate($img, 255, 255, 255);
        imagestring($img, 7, strlen($word) , 13, $word, $white);
        imagerectangle($img, 1, 1, 170 - 1, 40 - 1, $noir);
        
        imagepng($img);
	imagedestroy($img);
        
        $_SESSION['captcha'] = $word;
    }
    
    public static function getRandomWord(){
        $content = file_get_contents(PATH_APP_MODULE . 'captcha/words.txt');
        $words = explode("\n", $content);
        $w = $words[rand(0, count($words) - 1)];
        return trim($w);
    }
}