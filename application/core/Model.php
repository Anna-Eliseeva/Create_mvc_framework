<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018-12-21
 * Time: 15:26
 */

namespace application\core;

use application\lib\Db;

abstract class Model
{
    public $db;

    public function _construct()
    {
        /*Создаем экземпляр класса для работы с БД*/
        $this->db = new Db;
    }
}