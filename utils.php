<?php

function random_with_probability($p=100): bool {
    $ans = rand(1,100);
    if($ans<$p){
        return true;
    } else {
        return false;
    }
}
