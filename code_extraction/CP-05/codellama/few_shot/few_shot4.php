<?php

function trap(array $height): int {
    // Find the maximum height and its index
    $maxHeight = 0;
    $maxIndex = 0;
    foreach ($height as $i => $h) {
        if ($h > $maxHeight) {
            $maxHeight = $h;
            $maxIndex = $i;
        }
    }

    // Find the minimum height and its index
    $minHeight = 0;
    $minIndex = 0;
    for ($i = $maxIndex - 1; $i >= 0; $i--) {
        if ($height[$i] < $minHeight) {
            $minHeight = $height[$i];
            $minIndex = $i;
        }
    }

    // Calculate the trapped water
    $trappedWater = 0;
    for ($i = $minIndex; $i <= $maxIndex; $i++) {
        $trappedWater += min($height[$i], $minHeight) - $height[$i];
    }

    return $trappedWater;
}
