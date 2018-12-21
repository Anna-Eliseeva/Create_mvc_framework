<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018-12-19
 * Time: 22:15
 */

namespace application\controllers;

use application\core\Controller;
use application\lib\Db;


class MainController extends Controller
{
    public function indexAction()
    {

        $db = new Db;

       // $form = '2; DELETE FROM users'; //Представим будто тут данные из формы
        $params = [
            'id' => 2
        ];


        $data = $db->column('SELECT name FROM `users` WHERE `id` = :id', $params);
        $this->view->render('Главная страница');
    }
}