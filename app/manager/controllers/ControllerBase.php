<?php


namespace App\Manager\Controllers;


use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    //中间件
    public function initialize()
    {

    }

    //这个也可以是
    public function onConstruct()
    {

    }


    /**
     * @param null $key
     * @param null $default
     * @param string $filter
     * @return mixed
     * todo 获取get参数
     */
    public function get($key = null, $default = null, $filter = 'trim')
    {
        return $this -> request -> get($key,$filter,$default);
    }

    /**
     * @param null $key
     * @param null $default
     * @param string $filter
     * @return mixed
     * todo 获取post数据
     */
    public function post($key = null, $default = null, $filter = 'trim')
    {
        return $this -> request -> getPost($key,$filter,$default);
    }


    /**
     * @return \Phalcon\Http\File[]|\Phalcon\Http\Request\FileInterface[]
     * todo 获取文件
     */
    public function file()
    {
        return $this -> request -> getUploadedFiles();
    }

    /**
     * @param $content
     * @return \Phalcon\Http\Response|\Phalcon\Http\ResponseInterface
     * todo 返回json数据格式
     */
    public function json(array $content)
    {
        return $this -> response -> setJsonContent($content);
    }


    /**
     * @param $name
     * @param null $value
     * @param int $expire
     * @param string $path
     * @param bool|false $secure
     * @param string $domain
     * @param bool|false $httpOnly
     * @return \Phalcon\Http\Cookie|\Phalcon\Http\CookieInterface|\Phalcon\Http\Response\Cookies|\Phalcon\Http\Response\CookiesInterface
     * todo 设置 | 获取 cookie
     */
    public function cookie($name,$value = null,$expire = 86400,$path = '/',$secure = false,$domain = '.vmware.cn',$httpOnly = false)
    {
        if($value){
            return $this -> cookies -> set($name,$value,$expire,$path,$secure,$domain,$httpOnly);
        }else{
            return $this -> cookies -> get($name);
        }
    }

    /**
     * @param $name
     * @param null $value
     * todo 设置session
     */
    public function setSession($name, $value = null)
    {
        $this -> session -> set($name,$value);

    }


    /**
     * @param $name
     * @param null $default
     * @param bool|false $remove
     * @return mixed
     * todo 获取session
     */
    public function getSession($name,$default = null,$remove = false)
    {
        return $this -> session -> get($name,$default,$remove);
    }
}