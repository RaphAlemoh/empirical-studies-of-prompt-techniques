<?php

function trap($height) {
    $n = count($height);
    $left = 0;
    $right = $n - 1;
    $water = 0;
    $leftMax = $rightMax = 0;

    while ($left < $right) {
        if ($height[$left] <= $height[$right]) {
            // Move left pointer if the current height is smaller than the right max
            if ($height[$left] < $leftMax) {
                $water += $leftMax - $height[$left];
            } else {
                $leftMax = $height[$left];
            }
            $left++;
        } else {
            // Move right pointer if the current height is smaller than the left max
            if ($height[$right] < $rightMax) {
                $water += $rightMax - $height[$right];
            } else {
                $rightMax = $height[$right];
            }
            $right--;
        }
    }

    return $water;
}
