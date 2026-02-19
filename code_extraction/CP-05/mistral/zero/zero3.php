<?php

function trap($height) {
    $trappedWater = 0;
    $leftMax = [0];
    $rightMax = [];

    // Initialize left maximum array
    for ($i = 0; $i < count($height); $i++) {
        if (isset($leftMax[$i])) {
            $leftMax[$i] = max($leftMax[$i], $height[$i]);
        } else {
            $leftMax[$i] = $height[$i];
        }
    }

    // Initialize right maximum array
    for ($j = count($height) - 1; $j >= 0; $j--) {
        if (isset($rightMax[$j])) {
            $rightMax[$j] = max($rightMax[$j], $height[$j]);
        } else {
            $rightMax[$j] = $height[$j];
        }
    }

    // Calculate trapped water and sum it up
    for ($i = 0; $i < count($height); $i++) {
        $trappedWater += min($leftMax[$i], $rightMax[$i]) - $height[$i];
    }

    return $trappedWater;
}
