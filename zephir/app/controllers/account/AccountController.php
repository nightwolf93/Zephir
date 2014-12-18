<?php

namespace Zephir\App\Controllers\Account;

use Zephir\Logic\Controller;
use Zephir\App\Models\Forms\LoginForm;
use Zephir\Core\Database\Database;

class AccountController extends Controller {

    public function register($parameters){
        if($this->session()->exist('error')){
            $this->set('error', $this->session()->getFlash('error'));
        }
    }
    
    public function create($parameters){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];
        $secret_question = $_POST['secret_question'];
        $secret_answer = $_POST['secret_answer'];
        $captcha = $_POST['captcha_answer'];
        
        if(strstr($email, '@')){
            if(strlen($password) > 3 && $password == $password_confirm){
                if($secret_question != '' && $secret_answer != ''){
                    if($captcha == $_SESSION['captcha']){
                        $salt = \Zephir\Core\Utils\String::randomString(124);
                        
                        $cryptedPassword = md5(md5($password) + md5($salt));
                                
                        Database::getLink()->insert("accounts", array(
                            "email" => $email,
                            "password" => $cryptedPassword,
                            "salt" => $salt,
                            "secret_question" => $secret_question,
                            "secret_answer" => $secret_answer
                        ));
                        
                        $this->set('email', $email);
                    }
                    else {
                        $this->session()->set('error', "La réponse a la sécurité Anti-bot est incorrect");
                        $this->redirect('/account/register');
                    }
                }
                else {
                    $this->session()->set('error', "Certains champs sont manquant");
                    $this->redirect('/account/register');
                }
            }
            else {
                $this->session()->set('error', "Votre mot de passe doit faire plus de 3 caracteres ou n'est pas identique");
                $this->redirect('/account/register');
            }
        }
        else {
            $this->session()->set('error', "Le format de l'email est incorrect");
            $this->redirect('/account/register');
        }
    }
}