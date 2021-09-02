<?php

require_once "Config.php";
require_once "Individual.php";
require_once "Population.php";

$config = Config::getInstance();
$population = new Population();
$index = 0;
for ($i=0; $i<25; $i++){
    $population -> mutate_population();
    echo $population->get_best_fitness_score()."<br>";
    echo $population."<br>";
}
//while(!$population->is_goal_achieved() && $index < $config->EVOLUTION_CYCLES) {
//    echo "STEP ".$index."\n";
//    $population = evolution_step($population);
//    echo $population->get_best_fitness_score();
//    //echo $population;
//    $index++;
//}
//return $index;

function evolution_step($population){
    global $CURRENT_POPULATION;
    $population->choose_fittest();
    // should break out of the cycle immediately as fittest individual occur
    if($population->is_goal_achieved()){
        echo "BREAK\n";
        return $population;
    }
    $population->mutate_population();
    $CURRENT_POPULATION = $population;
    return $population;
}