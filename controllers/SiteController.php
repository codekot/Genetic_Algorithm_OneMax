<?php

namespace app\controllers;

use app\web\Application;

class SiteController
{
    public static function home(){
        $content = main();
        $params = [
            'content' => $content
        ];
        return Application::$app->router->renderView('home', $params);

    }

}