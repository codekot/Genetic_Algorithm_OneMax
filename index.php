<?php

require_once __DIR__."/vendor/autoload.php";

use app\web\Application;

$app = new Application();

$app->router->get('/', function (){
    return main();
});


$app->run();