<?php

function trap($height) {
    // find the maximum value in the array
    $max = max($height);
    // initialize the total water trapped to 0
    $totalWater = 0;
    // loop through each bar and check if it is the highest bar in its group
    for ($i = 0; $i < count($height) - 1; $i++) {
        // check if the current bar is the highest bar in its group
        if ($height[$i] === $max && $height[$i + 1] > $height[$i]) {
            // find the lowest bar in the group
            $lowestBar = $i;
            while ($height[$lowestBar] === $max) {
                $lowestBar--;
            }
            // calculate the amount of water that can be trapped in this group
            $waterTrapped = ($lowestBar - $i + 1) * $max;
            // add the amount of water to the total
            $totalWater += $waterTrapped;
        }
    }
    return $totalWater;
}
