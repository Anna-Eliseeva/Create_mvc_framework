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

    public function _construct($route) {
        $this->route = $route;
        $this->view = new View($route);

    }
}