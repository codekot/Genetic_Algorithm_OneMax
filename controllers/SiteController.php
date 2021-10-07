<?php

namespace app\controllers;

use app\web\Controller;

class SiteController extends Controller
{
    public static function home(){
        $content = main();
        $params = [
            'content' => $content
        ];
        return static::render('home', $params);

    }

}