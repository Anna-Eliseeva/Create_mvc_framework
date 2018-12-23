<?php

/*Включаем вывод всех ошибок*/
ini_set('display_errors', 1);
error_reporting(E_ALL);

/*создадим функцию которая будет распечатывать обьект*/
function debug($str)
{
    echo "<pre>";
    var_dump($str);
    echo "</pre>";
    exit;
}