<?php

require_once 'autoload.php';


class IndividualTest extends \PHPUnit\Framework\TestCase {

    private $config;

    protected function setUp(): void
    {
        $this->config = Config::getInstance();
    }

    protected function tearDown(): void
    {
        $this->config = null;
    }

    public function testNewIndividual(){
        $i = new Individual();
        $this -> assertInstanceOf(
            Individual::class,
            $i
        );
        //object has proper attributes
        $this -> assertObjectHasAttribute("array", $i, "Individual has no array attribute");
        $this -> assertObjectHasAttribute("fitness", $i, "Individual has no fitness attribute");
        $this -> assertObjectHasAttribute("personal_number", $i, "Individual has no personal number");

        //attributes of proper types
        $this -> assertIsArray($i->array);
        $this -> assertIsFloat($i->fitness);
        $this -> assertIsInt($i->personal_number);

        //attribute values within proper range
        $this -> assertContainsOnly("int", $i->array);
        $this -> assertContains(0, $i->array);
        $this -> assertContains(1, $i->array);
        $this -> assertNotContains(3, $i->array);

        $this -> assertEquals($this->config->INDIVIDUAL_LENGTH, count($i->array));

        $this -> assertLessThanOrEqual(1.0, $i->fitness);
        $this -> assertGreaterThanOrEqual(0.0, $i->fitness);
    }

    public function testGetFitness(){
        $i = new Individual();
        $this -> assertIsFloat($i->get_fitness());
        $i->array = $this->config->GOAL;
        $this -> assertEquals(1.0, $i->get_fitness());
    }

    public function testCloneIndividual(){
        $i = new Individual();
        $i_clone = $i->clone_individual();
        $this -> assertInstanceOf(
            Individual::class,
            $i_clone
        );
        $this -> assertNotEquals($i, $i_clone);
        $this -> assertEquals($i->fitness, $i_clone->fitness);
        $this -> assertEquals($i->array, $i_clone->array);
        $this -> assertEquals($i->personal_number + 1, $i_clone->personal_number);
    }

    public function testMutateIndividual(){
        $i = new Individual();
        $mutant = $i->mutate_individual();
        $this -> assertInstanceOf(
            Individual::class,
            $mutant);
        $this -> assertNotEquals($i, $mutant);
        $arrays_diff = array_diff_assoc($i->array, $mutant->array);
        $this -> assertLessThanOrEqual($this->config->MUTATION_RATE, count($arrays_diff));
    }

    public function testMutationWithChangingSetUp(){
        $this->config->MUTATION_RATE=5;
        $this -> assertEquals(5, $this->config->MUTATION_RATE);
        $this -> testMutateIndividual();
    }

}
