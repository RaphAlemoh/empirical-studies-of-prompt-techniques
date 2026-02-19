<?php

function trap(array $height): int {
    $leftMax = [];
    $rightMax = [];
    $maxHeight = 0;
    $totalWater = 0;

    for ($i = 1; $i < count($height) - 1; $i++) {
        $leftMax[$i] = max($leftMax[$i - 1], $height[$i]);
        $rightMax[$i] = max($rightMax[$i + 1], $height[$i]);
    }

    for ($i = 1; $i < count($height) - 1; $i++) {
        $maxHeight = max($maxHeight, min($leftMax[$i], $rightMax[$i]) - $height[$i]);
        $totalWater += $maxHeight;
    }

    return $totalWater;
}
