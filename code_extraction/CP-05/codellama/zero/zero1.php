<?php

function trap($height) {
    // create a new array to store the maximum height of water for each bar
    $maxHeights = [];
    
    // loop through each bar and calculate its maximum height
    for ($i = 0; $i < count($height); $i++) {
        $maxHeights[$i] = max($height[$i], $maxHeights[$i - 1]);
    }
    
    // calculate the total units of trapped water
    $trappedWater = 0;
    for ($i = 0; $i < count($height); $i++) {
        $trappedWater += min($maxHeights[$i], $maxHeights[$i - 1]) - $height[$i];
    }
    
    return $trappedWater;
}
