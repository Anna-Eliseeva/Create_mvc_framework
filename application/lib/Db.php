<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018-12-20
 * Time: 19:56
 */

namespace application\lib;
class Db
{
    protected $db;

    public function _construct()
    {
        $config = require 'application/config/db.php';

        /*Создаем подключение к БД*/
        $this->db = new \PDO(
            "mysql:host={$config['host']};dbname={$config['name']}", $config['user'], $config['password']);
    }

    /*Создаем функцию которая будет переходить к методу query*/
    public function query($sql, $params = [])
    {
        $stmt = $this->db->prepare($sql);
        /*Создаем защиту от sql иньекций*/
        if (!empty($params)) {
            foreach ($params as $key => $val) {
                $stmt->bindValue(':' . $key, $val);
            }
        }
        $stmt->execute();
        return $stmt;
    }

    public function row($sql, $params = [])
    {
        $result = $this->query($sql);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function column($sql, $params = [])
    {
        $result = $this->query($sql);
        return $result->fetchColumn();
    }
}