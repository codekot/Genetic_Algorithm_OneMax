<?php

namespace app\classes;
//require_once "Population.php";

class Evolution
{
    static private ?Config $config = null;
    public Population $population;
    public $steps;

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
        return;
    }

    public function evolution_cycle(){

        $index = 0;
        while(!$this->population->is_goal_achieved() && $index < self::$config->EVOLUTION_CYCLES) {
            $this->evolution_step();
            $index++;
        }
        $this->steps = $index;
        return $index;
    }
}