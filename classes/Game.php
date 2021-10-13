<?php


namespace app\classes;


class Game
{
    public static function variate(){
        $config = Config::getInstance();

    }

    public static function process(){
        $db = Database::getInstance();
        $config = Config::getInstance();
        $iterations  = $config->ITERATIONS;
        $results = [];
        for($i=0; $i<$iterations; $i++){
            $evolution = new Evolution();
            $evolution->evolution_cycle();
            $results[] = $evolution->steps;
        }
        $average = array_sum($results)/count($results);
        $max = max($results);
        $min = min($results);
//        $db_result = [
//            "max" => $max,
//            "min" => $min,
//            "average" => $average
//        ];
        $db_result = compact($max, $min, $average);
        $db->insert($db_result);
        //echo json_encode($results)."\n";
        $result = "";
        $result .= "<p>$iterations iterations implemented</p>";
        $result .= "<p>Average number of steps to achieve goal fitness $average</p>";
        $result .= "<p>Minimum number of steps to achieve goal fitness $min</p>";
        $result .= "<p>Maximum number of steps to achieve goal fitness $max</p>";
        return $result;
        $from_db = $db->getAll();
        echo "<script> console.log($from_db)</script>";
    }

}