<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018-12-19
 * Time: 21:40
 */

namespace application\core;


class View
{
    public $path; //Путь к нашему виду
    public $route;
    public $layout = 'default'; //Шаблон

    public function _construct($route)
    {
        $this->route = $route;
        $this->path = $route['controller'] . '/' . $route['action'];
    }

    public function render($title, $vars = [])
    {
        /*Напишем функцию которая массив распакует в переменную*/
        extract($vars);
        $path = 'application/views/' . $this->path . '.php';
        if (file_exists($path)) {
            ob_start();

            /*Подключаем шаблон*/
            require $path;
            $content = ob_get_clean();
            require 'application/views/layouts/' . $this->layout . '.php';
        }
    }

    /*метод лля перенаправления страниц*/
    public function redirect($url)
    {
        header('Location:' . $url);
        exit;

    }

    /*создаем метод для отображения ошибок*/
    public static function errorCode($code)
    {
        /*С помощью функции отдаем соответсвующий заголовок*/
        http_response_code($code);
        $path = 'application/views/errors/' . $code . '.php';
        /*Делаем проверку на существование файла*/
        if (file_exists($path)) {

            /*Подключаем файл с страницами ошибок*/
            require $path;
        }
        exit;
    }

    public function message($status, $message)
    {
        exit(json_encode(['status' => $status, 'message' => $message]));
    }

    public function location($url, $message)
    {
        exit(json_encode(['url' => $url]));
    }


}