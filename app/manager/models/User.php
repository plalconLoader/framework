<?php

namespace App\Manager\Models;
use Phalcon\Mvc\Model;
class User extends Base
{
    //框架获取表名
    public function getSource()
    {
        return 'users';
    }
}