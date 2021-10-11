<?php

namespace app\controllers;

use app\classes\Game;
use app\web\Controller;

class SiteController extends Controller
{
    public static function home(){
        $content = Game::process();
        $params = [
            'content' => $content
        ];
        return static::render('home', $params);

    }

}