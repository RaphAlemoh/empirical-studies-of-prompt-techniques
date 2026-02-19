<?php

function trap($height) {
    $n = count($height);
    $trappedWater = 0;
    $left = 0;
    $right = $n - 1;
    $leftMax = $rightMax = 0;

    while ($left < $right) {
        if ($height[$left] <= $height[$right]) {
            $leftMax = max($leftMax, $height[$left]);
            $trappedWater += $leftMax - $height[$left];
            $left++;
        } else {
            $rightMax = max($rightMax, $height[$right]);
            $trappedWater += $rightMax - $height[$right];
            $right--;
        }
    }

    return $trappedWater;
}
