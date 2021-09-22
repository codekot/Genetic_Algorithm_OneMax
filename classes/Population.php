<?php

require_once "Config.php";
require_once "Individual.php";

// TODO: implement mutation with clossing

class Population{
    static private $config = null;

    public array $set;
    public bool $goal_achieved = false;
    public int $steps = 0;

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
        $fittest_quote = self::$config->FITTEST_QUOTE;
        //echo "FQ ".$fittest_quote."\n";
        // first part is highest ranked on quantity of FITTEST_QUOTE and is parent for mutants
        // second part remain
        // third part is mutated
        // last part is random
        $half = intval(count($this->set)/2);
        //echo "HALF ".$half."\n";
        for ($i=$half; $i<$fittest_quote+$half; $i++){
            //echo "I ".$i."\n";
            $this->set[$i] = $this->set[$i-$half]->mutate_individual();
            //echo $this->set[$i];
        }
        for ($i=$half+$fittest_quote; $i<count($this->set); $i++){
            $this->set[$i] = new Individual();
        }
        $this->choose_fittest();
    }

}

//$p = new Population();
//echo $p;
//$p->mutate_population();
//echo $p;