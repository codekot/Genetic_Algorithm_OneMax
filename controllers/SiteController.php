<?php

namespace app\controllers;

use app\web\Application;
use app\web\Controller;

class SiteController extends Controller
{
    public static function home(){
        $content = main();
        $params = [
            'content' => $content
        ];
        //return Application::$app->router->renderView('home', $params);
        return static::render('home', $params);

    }

}