<?php

function trap($height) {
    $n = count($height);
    $left = 0;
    $right = $n - 1;
    $total_water = 0;
    $left_max = 0;
    $right_max = 0;

    while ($left < $right) {
        if ($height[$left] < $height[$right]) {
            // If left max is smaller, move left pointer and update total water and left max accordingly.
            if ($height[$left] > $left_max) {
                $left_max = $height[$left];
            } else {
                $total_water += $left_max - $height[$left];
            }
            $left++;
        } else {
            // If right max is smaller, move right pointer and update total water and right max accordingly.
            if ($height[$right] > $right_max) {
                $right_max = $height[$right];
            } else {
                $total_water += $right_max - $height[$right];
            }
            $right--;
        }
    }

    return $total_water;
}
