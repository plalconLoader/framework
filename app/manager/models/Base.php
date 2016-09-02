<?php

namespace App\Manager\Models;


use Phalcon\Mvc\Model;

class Base extends Model
{
    public function initialize()
    {
        $this -> setReadConnectionService('dbRead'); //读
        $this -> setWriteConnectionService('dbWrite'); //写
    }
}