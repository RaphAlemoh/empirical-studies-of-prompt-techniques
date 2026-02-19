<?php

function trap(array $height): int {
    $leftMax = array_fill(0, count($height), 0);
    $rightMax = array_fill(0, count($height), 0);
    for ($i = 1; $i < count($height) - 1; $i++) {
        $leftMax[$i] = max($leftMax[$i - 1], $height[$i]);
        $rightMax[$i] = max($rightMax[$i + 1], $height[$i]);
    }
    $trappedWater = 0;
    for ($i = 1; $i < count($height) - 1; $i++) {
        $trappedWater += min($leftMax[$i], $rightMax[$i]) - $height[$i];
    }
    return $trappedWater;
}
