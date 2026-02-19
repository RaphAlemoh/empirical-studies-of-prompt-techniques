<?php

function trap(array $height): int {
    $leftMax = [];
    $rightMax = [];
    for ($i = 0; $i < count($height); $i++) {
        $leftMax[$i] = max($height[0], $height[$i]);
        $rightMax[$i] = max($height[count($height) - 1], $height[$i]);
    }

    for ($i = 1; $i < count($height); $i++) {
        $leftMax[$i] = max($leftMax[$i - 1], $height[$i]);
        $rightMax[$i] = max($rightMax[$i + 1], $height[$i]);
    }

    $trappedWater = 0;
    for ($i = 0; $i < count($height); $i++) {
        $trappedWater += min($leftMax[$i], $rightMax[$i]) - $height[$i];
    }

    return $trappedWater;
}
