<?php


class DefaultConfig
{
    public static $INDIVIDUAL_LENGTH = 4;
    public static $IND_NUMBER = 1;
    public static $POPULATION_SIZE = 10;
    public static $BORDER = 4;
    public static $MUTATION_RATE = 6;
    public static $FITTEST_QUOTE = 3;
    public static $EVOLUTION_CYCLES = 1000;
    public static $CURRENT_POPULATION = [];
    public static $ITERATIONS = 1000;
}

$i = "INDIVIDUAL_LENGTH";
echo DefaultConfig::$$i;