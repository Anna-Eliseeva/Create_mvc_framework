<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018-12-19
 * Time: 22:15
 */

namespace application\controllers;

use application\core\Controller;


class MainController extends Controller
{
    public function indexAction()
    {
        $result = $this->model->getNews();
        $vars = [
            'news' => $result,
        ];
        $this->view->render('Главная страница', $vars);
    }
}