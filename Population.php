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

    public function get_best_fittest_score(){
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
        if ($this->get_best_fittest_score() >= 1.0){
            $this->goal_achieved = true;
            return true;
        }  else {
            $this->goal_achieved = false;
            return false;
        }
    }

    function mutate_population(){
        // TODO need to be combed
        $fitness_quote = self::$config->FITTEST_QUOTE;
        // take first four of population and mutate it and fill the second half
        // fifth remain
        // last is random
        for ($i=0; $i<$fitness_quote; $i++){
            $this->set[$i+5] = $this->set[$i]->mutate_individual();
        }
        $this->set[9] = new Individual();
        $this->choose_fittest();
    }

}
