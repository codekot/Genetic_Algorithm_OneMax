<?php

require_once "Config.php";
require_once "Population.php";


class PopulationTest extends \PHPUnit\Framework\TestCase
{
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
        $best = $p->get_best_fittest_score();
        $i_fitness = $p->set[0]->get_fitness();
        $this -> assertEquals($i_fitness, $best);
    }

    function testIsGoalAchieved(){
        $p = new Population();
        $p->set[0]->fitness = 1.0;
        $result = $p->is_goal_achieved();
        $this -> assertTrue($result);
    }

}