<?php

namespace app\controllers;

use app\web\Application;

class SiteController
{
    public static function home(){
        $params = [
            'name' => 'Sean'
        ];
        return Application::$app->router->renderView('home', $params);

    }

}