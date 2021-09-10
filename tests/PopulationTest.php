<?php

require_once "Config.php";
require_once "Population.php";


class PopulationTest extends \PHPUnit\Framework\TestCase
{
    private $config;

    protected function setUp(): void
    {
        $this->config = Config::getInstance();
    }

    protected function tearDown(): void
    {
        $this->config = null;
    }

    function testNewPopulation(){
        $p = new Population();
        $this -> assertInstanceOf(
            Population::class,
            $p
        );
        $this -> assertObjectHasAttribute("set", $p);
        $this -> assertObjectHasAttribute("goal_achieved", $p);
        $this -> assertIsArray($p->set);
        $this -> assertIsBool($p->goal_achieved);
        $this -> assertContainsOnly("object", $p->set);
        $this -> assertContainsOnlyInstancesOf("Individual", $p->set);
    }

    function testChooseFittest(){
        $p = new Population();
        $prev = $p->set[0];
        foreach($p->set as $i){
            $this -> assertLessThanOrEqual($prev, $i);
            $prev = $i;
        }
    }

    function testBestFittestScore(){
        $p = new Population();
        $best = $p->get_best_fitness_score();
        $i_fitness = $p->set[0]->get_fitness();
        $this -> assertEquals($i_fitness, $best);
    }

    function testIsGoalAchieved(){
        $p = new Population();
        $p->set[0]->fitness = 1.0;
        $result = $p->is_goal_achieved();
        $this -> assertTrue($result);
    }

    function testMutatePopulation(){
        //TODO: test that needed part of population changing
        $p = new Population();
        $p_control = clone $p;
        $p->mutate_population();
        $this -> assertNotEquals($p_control,$p);
        $this -> assertEquals($this->config->POPULATION_SIZE, count($p->set));
        $this -> assertGreaterThanOrEqual($p_control->get_best_fitness_score(), $p->get_best_fitness_score());
    }
}