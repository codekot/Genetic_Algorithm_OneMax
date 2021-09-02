<?php

require_once "Config.php";
require_once "Individual.php";

class Population{
    static private $config = null;

    public array $set;
    public bool $goal_achieved = false;

    public function __construct(){
       if(!self::$config){
            self::$config = Config::getInstance();
       }
       $size = self::$config->POPULATION_SIZE;
       for ($i=0; $i<$size; $i++){
            $this->set[] = new Individual();
       }
       $this->choose_fittest();
    }

    public function choose_fittest(){
        rsort($this->set);
    }

    public function get_best_fitness_score(){
        $this->choose_fittest();
        return $this->set[0]->fitness;
    }

    public function __toString(){
        $result = "POPULATION\n";
        foreach($this->set as $individual){
            $result .= $individual->__toString();
        }
        return $result;
    }

    public function is_goal_achieved(): bool{
        if ($this->get_best_fitness_score() >= 1.0){
            $this->goal_achieved = true;
            return true;
        }  else {
            $this->goal_achieved = false;
            return false;
        }
    }

    function mutate_population(){
        $fitness_quote = self::$config->FITTEST_QUOTE;
        // first part is highest ranked on quantity of FITTEST_QUOTE and is parent for mutants
        // second part remain
        // third part is mutated
        // last part is random
        $half = intval(count($this->set)/2);
        for ($i=$half; $i<$fitness_quote; $i++){
            $this->set[$i] = $this->set[$i]->mutate_individual();
        }
        for ($i=$half+$fitness_quote; $i<count($this->set); $i++){
            $this->set[$i] = new Individual();
        }
        $this->choose_fittest();
    }

}
