<?php


class Individual {
    static private int $current_number = 1;
    static public ?Config $config = null;

    public float $fitness;
    public int $personal_number;
    public array $array;

    public function __construct(){
        if(!self::$config){
            self::$config = Config::getInstance();
        }
        $this->array = self::generate_array();
        $this->fitness = self::get_fitness();
        $this->personal_number = self::get_number();
    }

    static private function generate_array(): array{
        $ind_length = self::$config->INDIVIDUAL_LENGTH;
        $result = [];
        for($i=0; $i<$ind_length; $i++){
            $result[] = array_rand([0,1]);
        }
        return $result;
    }

    public function get_fitness(): float{
        $goal = self::$config->GOAL;
        $f = array_sum($this->array)/array_sum($goal);
        $this->fitness = $f;
        return $f;
    }

    static public function get_number(): int
    {
        $number = self::$current_number;
        self::$current_number ++;
        return $number;
    }

    public function __toString(){
        return "Individual #$this->personal_number, fitness: $this->fitness ".json_encode($this->array)."\n";
    }

    public function clone_individual(): Individual
    {
        $clone = clone $this;
        $clone->personal_number = self::get_number();
        return $clone;
    }

    public function mutate_individual(): Individual
    {
        $mutation_rate = self::$config->MUTATION_RATE;
        $ind_length = self::$config->INDIVIDUAL_LENGTH;
        // choose which genes will be mutated
        $index_array = [];
        for($i=0; $i<$mutation_rate; $i++){
            $index_value = rand(0, $ind_length-1);
            if(!in_array($index_value, $index_array)) {
                $index_array[] = $index_value;
            }
        }

        // mutate selected genes with some probability
        $clone = $this->clone_individual();
        foreach($index_array as $index){
            if(random_with_probability()){
                $clone->array[$index] = $clone->array[$index] ? 0 : 1;
            }
        }
        $clone->get_fitness();
        return $clone;
    }
}
