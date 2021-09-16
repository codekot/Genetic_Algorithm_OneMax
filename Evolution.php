<?php

require_once "Population.php";

class Evolution
{
    static private $config = null;
    public $population;

    public function __construct(){
        if(!self::$config){
            self::$config = Config::getInstance();
        }
        $this->population = new Population();
    }

    public function evolution_step(){
        $this->population->choose_fittest();
        // should break out of the cycle immediately as fittest individual occur
        if($this->population->is_goal_achieved()){
            echo "BREAK\n";
            //return $this->population;
            return;
        }
        $this->population->mutate_population();
        echo $this->population;
        //return $this->population;
        return;
    }

    public function evolution_cycle(){

        //$IND_NUMBER = 1;
        //$population = new Population();
        $index = 0;
        while(!$this->population->is_goal_achieved() && $index < $config->EVOLUTION_CYCLES) {
            echo "STEP ".$index."\n";
            $this->evolution_step();
            echo $this->population->get_best_fittest_score();
            //echo $population;
            $index++;
        }
        return $index;
    }
}