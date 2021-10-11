<?php

namespace app\controllers;

use app\classes\Config;
use app\classes\Game;
use app\web\Controller;

class SiteController extends Controller
{
    public static function home(){
        $content = Game::process();
        $c = Config::getInstance();
        $data = get_class_vars(get_class($c));
        if(!$data){
            $data = "something goes wrong";
        } else {
            $data = json_encode($data);
        }
        $params = [
            'data' => $data,
            'content' => $content
        ];
        return static::render('home', $params);

    }

}