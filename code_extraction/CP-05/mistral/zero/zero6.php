<?php

function trap($height) {
    $n = count($height);
    $left = 0;
    $right = $n - 1;
    $total_water = 0;
    $left_max = $height[$left];
    $right_max = $height[$right];

    while ($left < $right) {
        if ($left_max <= $right_max) {
            $left++;
            $left_max = max($left_max, $height[$left]);
            $total_water += ($left_max - $height[$left]) > 0 ? ($left_max - $height[$left]) : 0;
        } else {
            $right--;
            $right_max = max($right_max, $height[$right]);
            $total_water += ($right_max - $height[$right]) > 0 ? ($right_max - $height[$right]) : 0;
        }
    }

    return $total_water;
}
