<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018-12-19
 * Time: 21:31
 */

namespace application\core;

use application\core\View;

abstract class Controller
{
    public $route;
    public $view;
    public $acl;

    public function _construct($route)
    {
        $this->route = $route;
        if (!$this->checkAcl()) {
            View::errorCode(403);
        };
        $this->view = new View($route);
        $this->model = $this->LoadModel($route['controller']);
    }

    /*Создадим функцию для автозагрузки модели*/
    public function loadModel($name)
    {
        /*Создаем путь к модели*/
        $path = 'application\models\\' . ucfirst($name);

        /*Делаем проверку на существование данного класса*/
        if (class_exists($path)) {
            return new $path;
        }
    }

    /*Создадим функцию для загрузки нужного controller list*/
    public function checkAcl()
    {
        /*Загружаем наш config*/
        $this->acl = require 'application/acl/' . $this->route['controller'] . '.php';

        /*Создаем условия для каждой группы пользователей*/
        if ($this->isAcl('all')) {
            return true;
        } elseif (isset($_SESSION['authorize']['id']) and $this->isAcl('authorize')) {
            return true;
        } elseif (!isset($_SESSION['authorize']['id']) and $this->isAcl('guest')) {
            return true;
        } elseif (isset($_SESSION['admin']) and $this->isAcl('admin')) {
            return true;
        }
        return false;


    }

    public function isAcl($key)
    {
        return in_array($this->route['action'], $this->acl[$key]);
    }
}