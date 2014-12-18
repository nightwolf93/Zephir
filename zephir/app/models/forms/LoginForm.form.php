<?php

namespace Zephir\App\Models\Forms;

use Zephir\Core\Logic\Form;

class LoginForm extends Form {
    
    public function __construct() {
        $this
            ->add('username', 'text')
            ->add('password', 'password')
            ->add('submit', 'submit', array('value' => 'Connexion'));
        
        parent::__construct("loginForm", "LoginFormTemplate");
    }
}