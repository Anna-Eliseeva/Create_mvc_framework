<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018-12-19
 * Time: 21:25
 */

namespace application\controllers;

use application\core\Controller;

class AccountController extends Controller
{


    public function loginAction(){
        $this->view->render('Вход');
    }

    public function registerAction(){

        $this->view->render('Регистрация');
    }
}