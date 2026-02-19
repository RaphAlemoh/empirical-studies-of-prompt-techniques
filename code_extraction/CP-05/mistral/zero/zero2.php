<?php

function trap($height) {
    $n = count($height);
    $left = 0;
    $right = $n - 1;
    $trappedWater = 0;
    $minLeft = $height[$left];

    while ($left < $right) {
        if ($height[$left] < $minLeft) {
            $minLeft = min($height[$left], $minLeft);
            $trappedWater += $minLeft - $height[$left];
        }
        if ($height[$right] < $minLeft) {
            $minLeft = min($height[$right], $minLeft);
        } else {
            $right--;
        }
        $left++;
    }

    return $trappedWater;
}
