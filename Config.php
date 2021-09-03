<?php

class Config{
    private  $INDIVIDUAL_LENGTH = 4;
    private  $GOAL = [];
    public $IND_NUMBER = 1;
    public $POPULATION_SIZE = 10;
    public $BORDER = 4;
    public $MUTATION_RATE = 6;
    private $FITTEST_QUOTE = 3;
    public $EVOLUTION_CYCLES = 1000;
    public $CURRENT_POPULATION = [];
    public $ITERATIONS = 1000;

    private static $instance = null;

    public static function getInstance(): Config
    {
        if(static::$instance === null){
            static::$instance = new static();
            static::$instance->GOAL = static::$instance->setGoal();
        }
        return static::$instance;
    }

    protected function __construct(){
    }

    protected function __clone(){
    }

    public function setGoal(): array
    {
        return array_map(function (){return 1;}, range(1, $this->INDIVIDUAL_LENGTH));
    }

    public function __set($name, $value){
        if(!property_exists($this, $name)){
            throw new Exception("invalid property name");
        } elseif ($name == "INDIVIDUAL_LENGTH"){
            $this->INDIVIDUAL_LENGTH = $value;
            $this->GOAL = $this->setGoal();
        } elseif ($name == "GOAL"){
            throw new Exception("access denied, to change GOAL, change INDIVIDUAL_LENGTH");
        } elseif ($name == "FITTEST_QUOTE"){
            throw new Exception("error");
//            if($value > intval($this->POPULATION_SIZE/2)){
//                throw new Exception("error");
//            } else {
//                $this->FITTEST_QUOTE = $value;
//            }
        }
    }

    public function __get($name){
        if($name == "INDIVIDUAL_LENGTH"){
            return $this->INDIVIDUAL_LENGTH;
        } elseif ($name == "GOAL"){
            return $this->GOAL;
        } elseif ($name == "FITTEST_QUOTE"){
            return $this->FITTEST_QUOTE;
        }
        else {
            throw new Exception("invalid property name");
        }
    }
}
