<?php

require_once __DIR__ . "/../vendor/autoload.php";

use app\controllers\SiteController;
use app\web\Application;

$app = new Application(dirname(__DIR__));

//$app->router->get('/', function (){
//    return main();
//});

$app->router->get('/', [SiteController::home, 'home']);

$app->router->get('/about', 'about');



$app->run();