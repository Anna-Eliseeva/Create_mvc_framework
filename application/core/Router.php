<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018-12-19
 * Time: 18:54
 */

namespace application\core;

use application\core\View;

class Router
{
    protected $routes = [];
    protected $params = [];

    public function _construct()
    {
        $arr = require 'application/config/routes.php';
        foreach ($arr as $key => $val) {
            $this->add($key, $val);
        }
    }

    /*Добавление маршрута*/
    public function add($route, $params)
    {
        $route = '#^' . $route . '$#';

        /*После данной записи в переменной routes на 13 строке хранится массив из файла routes.php но ключи являются
        регулярными выражениями*/
        $this->routes[$route] = $params;

    }

    /*Проверка на существование маршрута*/
    public function match()
    {
        /*Получим текущий url на котором мы находимся*/
        $url = trim($_SERVER['REQUEST_URI'], '/');

        /*Цикл который перебирает массив маршрутов и в переменную записывает значения*/
        foreach ($this->routes as $route => $params) {

            /*Проверяем соответсвие данных*/
            if (preg_match($route, $url, $matches)) {
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    /*Запуск роутера*/
    public function run()
    {
        if ($this->match()) {

            $path = 'application\controllers\\' . ucfirst($this->params['controller']) . 'Controller';

            /*Проверка на существование класса*/
            if (class_exists($path)) {
                $action = $this->params['action'] . 'Action';

                /*Проверка на сущетвование метода*/
                if (method_exists($path, $action)) {
                    $controller = new $path($this->params);
                    $controller->$action();
                } else {
                    View::errorCode(404);
                }
            } else {
                View::errorCode(404);
            }
        } else {
            View::errorCode(404);
        }
    }

}
