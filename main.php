<?php

require_once "Config.php";
require_once "Individual.php";
require_once "Population.php";

$population = new Population();
$config = Config::getInstance();

$index = 0;

while(!$population->is_goal_achieved() && $index < $config->EVOLUTION_CYCLES) {
    echo "STEP ".$index."\n";
    $population = evolution_step($population);
    echo $population->get_best_fitness_score();
    //echo $population;
    $index++;
}
return $index;

function evolution_step($population){
    $population->choose_fittest();
    // should break out of the cycle immediately as fittest individual occur
    if($population->is_goal_achieved()){
        echo "BREAK\n";
        return $population;
    }
    $population->mutate_population();
    echo $population;
    return $population;
}

function evolution_cycle(){

    $IND_NUMBER = 1;
    $population = new Population();
    $index = 0;
    while(!$population->is_goal_achieved() && $index < $EVOLUTION_CYCLES) {
        echo "STEP ".$index."\n";
        $population = evolution_step($population);
        echo $population->get_best_fittest_score();
        //echo $population;
        $index++;
    }
    return $index;
}

function main(){
    $config = Config::getInstance();
    $population = new Population();
    $index = 0;
    for ($i=0; $i<25; $i++){
        $population -> mutate_population();
        echo $population->get_best_fitness_score()."<br>";
        echo $population."<br>";
    $iterations  = $config->ITERATIONS;
    $results = [];
    for($i=0; $i<$iterations; $i++){
        $results[] = evolution_cycle();
    }
    $average = array_sum($results)/count($results);
    $max = max($results);
    $min = min($results);
    echo json_encode($results)."\n";
    echo "Average number of steps to achieve goal fitness $average\n";
    echo "Minimum number of steps to achieve goal fitness $min\n";
    echo "Maximum number of steps to achive goal fitness $max\n";
    }
}


