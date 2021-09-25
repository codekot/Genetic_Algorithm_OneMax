<?php

use app\classes\Config;
use app\classes\Population;
use app\classes\Evolution;


function main(){
    $config = Config::getInstance();
    $iterations  = $config->ITERATIONS;
    $results = [];
    for($i=0; $i<$iterations; $i++){
        $evolution = new Evolution();
        $evolution->evolution_cycle();
        $results[] = $evolution->steps;
    }
    $average = array_sum($results)/count($results);
    $max = max($results);
    $min = min($results);
    //echo json_encode($results)."\n";
    $result = "";
    $result .= "<p>$iterations iterations implemented</p>";
    $result .= "<p>Average number of steps to achieve goal fitness $average</p>";
    $result .= "<p>Minimum number of steps to achieve goal fitness $min</p>";
    $result .= "<p>Maximum number of steps to achieve goal fitness $max</p>";
    return $result;
}
