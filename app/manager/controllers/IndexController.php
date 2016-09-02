<?php

namespace App\Manager\Controllers;
use App\Manager\Models\User;
use Phalcon\Mvc\Controller;

class IndexController extends ControllerBase
{

    public static $models = [
        'u' => User::class
    ];
    /**
     * @return string
     */
    public function indexAction()
    {
        //self::cookie('key','value');//设置cookie

        //self::cookie('key');//获取cookie

        $this -> view -> disable(); //禁止视图展示
    }
}