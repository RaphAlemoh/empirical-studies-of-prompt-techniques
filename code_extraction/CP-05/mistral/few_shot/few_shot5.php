<?php

function trap(array $height): int {
    $n = count($height);
    if ($n <= 1) return 0;

    $leftMax = new SplMaxHeap();
    $rightMax = new SplMinHeap();
    $leftMax->insert($height[0]);

    $unitsTrapped = 0;

    for ($i = 1; $i < $n; $i++) {
        // Insert current element to the right max heap
        $rightMax->insert($height[$i]);

        // If current element is greater than left max, pop from left max heap
        if ($height[$i] > $leftMax->getCurrent()) {
            $leftMax->extract();
        }

        // Calculate the water level between left and right maximum heights
        $waterLevel = min($leftMax->getCurrent(), $rightMax->getCurrent()) - $height[$i];

        // If water level is positive, add it to total units trapped
        if ($waterLevel > 0) {
            $unitsTrapped += $waterLevel;
        }
    }

    // Insert last element to the left max heap for calculating trapped water in the last column
    $leftMax->insert($height[$n - 1]);

    for ($i = $n - 2; $i >= 0; $i--) {
        if ($height[$i] > $leftMax->getCurrent()) {
            $leftMax->extract();
        }

        // Calculate the water level between left and right maximum heights
        $waterLevel = min($leftMax->getCurrent(), $rightMax->getCurrent()) - $height[$i];

        // If water level is positive, add it to total units trapped
        if ($waterLevel > 0) {
            $unitsTrapped += $waterLevel;
        }
    }

    return $unitsTrapped;
}
