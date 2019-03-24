<?php

namespace Stoa\Core;

use Stoa\Controller\IndexController;

class Dispatcher
{
    public static function dispatch()
    {
        $url = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

        array_shift($url);

        // get controller name
        $controller = !empty($url[0]) ? $url[0] . 'Controller' : 'IndexController';

        // get method name of controller
        $method = !empty($url[1]) ? $url[1] : 'index';

        // get argument passed in to the method
        $arg = !empty($url[2]) ? $url[2] : NULL;

        // create controller instance and call the specified method
        $file = $controller . '.php';
        require_once('Stoa/Controller/' . $file);
        unset($file);
        $cont = new $controller;

        $cont->$method($arg);
    }
}
