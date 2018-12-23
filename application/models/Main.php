<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018-12-21
 * Time: 15:18
 */

namespace application\models;

use application\core\Model;

class Main extends Model
{
    /**/
    public function getNews()
    {
        $result = $this->db->row('SELECT `title`, `text` FROM `news`');
        return $result;
    }
}