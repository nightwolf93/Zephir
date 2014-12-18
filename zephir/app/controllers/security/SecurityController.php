<?php

namespace Zephir\App\Controllers\Security;

use Zephir\Logic\Controller;
use Zephir\App\Models\Forms\LoginForm;
use Zephir\Core\Database\Database;
use Zephir\App\Modules\CaptchaModule;

class SecurityController extends Controller {

    public function captcha($parameters){
        CaptchaModule::buildCaptcha();
        exit();
    }
}