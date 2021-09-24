<?php

spl_autoload_register(function ($classname){
    include_once "classes/".$classname.".php";
});