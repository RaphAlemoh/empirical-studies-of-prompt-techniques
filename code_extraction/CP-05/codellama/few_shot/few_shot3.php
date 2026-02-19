<?php

function trap(array $height): int {
    // Find the highest bar and the lowest bar
    $highest = -1;
    $lowest = 100000;

    foreach ($height as $i => $bar) {
        if ($bar > $highest) {
            $highest = $bar;
        }
        if ($bar < $lowest) {
            $lowest = $bar;
        }
    }

    // Calculate the total water trapped
    $totalWater = 0;

    foreach ($height as $i => $bar) {
        $water = min($highest - $bar, $lowest - $bar);
        if ($water > 0) {
            $totalWater += $water;
        }
    }

    return $totalWater;
}
