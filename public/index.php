<?php

use Phalcon\Mvc\Router;
use Phalcon\Mvc\Application;
use Phalcon\Di\FactoryDefault;
use Phalcon\Config\Adapter\Ini;
use Phalcon\Db\Adapter\Pdo\Mysql;
$di = new FactoryDefault();

// 自定义路由
$di->set('router', function () {

    $router = new Router();

    $router -> setDefaultModule("wechat"); //默认导向路由

    //后台路由
    $router->add(
        '/:controller/:action',
        array(
            'module'     => 'manager',
            'controller' => 1,
            'action'     => 2
        )
    ) -> setHostname('manager.phalcon.vmware.cn');

    return $router;
});



$ini = new Ini('../config/database.ini'); //获取数据库配置文件

//写
$di -> setShared('dbWrite',function () use ($ini){
    $config = (array) $ini -> get('write');
    return new Mysql($config);
});


//读
$di -> setShared('dbRead',function () use ($ini){

    $config = (array) $ini -> get('read');
    return new Mysql($config);
});



try {

    // 创建应用
    $application = new Application($di);

    //注册 composer自动加载
    $loader = new \Phalcon\Loader();
    $loader -> registerFiles([
        '../vendor/autoload.php'
    ])
            -> register();



    // 注册模块
    $application->registerModules(
        array(
            'manager' => array(
                'className' => App\Manager\Module::class,
                'path'      => '../app/manager/Module.php',
            ),
            'wechat'  => array(
                'className' => App\Wechat\Module::class,
                'path'      => '../app/wechat/Module.php',
            )
        )
    );


    // 处理请求
    $response = $application->handle();

    $response->send();

} catch (\Exception $e) {
    echo $e->getMessage();
}