<?php

require_once __DIR__ . 'application/lib/Dev.php';

use application\core\Router;


/*Создадим функцию автозагрузки*/
spl_autoload_register(function ($class) {

    /*Заменяем слэши на обратные*/
    $path = str_replace('\\', '/', $class . '.php');

    /*Создаем проверку на существование файла*/
    if (file_exists($path)) {
        require $path;
    }
});

/*Делаем старт сессий*/
session_start();

$router = new Router;
$router->run();