<?php

function trap($height){
    $current_height = array_shift($height);
    $sum = $current_height;
    while ($height != []){
        if (count(array_keys($height)) > 1 && $current_height <= max($height)){
            unset($height[max($height)]);
        } else {
            $height[] -= $current_height;
        }
    };

    return $sum;
}
