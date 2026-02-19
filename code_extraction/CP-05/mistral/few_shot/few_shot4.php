<?php

function trap(array $height): int {
    $n = count($height);
    if ($n <= 1) return 0;

    $leftMax = array_fill(0, $n, PHP_INT_MIN);
    $rightMax = array_fill(0, $n, PHP_INT_MIN);

    // Initialize left and right maximum heights from left to right
    for ($i = 0; $i < $n; ++$i) {
        $leftMax[$i] = max($leftMax[$i], $height[$i]);
    }

    // Initialize left and right maximum heights from right to left
    for ($i = $n - 1; $i >= 0; --$i) {
        $rightMax[$i] = max($rightMax[$i], $height[$i]);
    }

    $trappedWater = 0;

    // Calculate trapped water by comparing left and right maximum heights for each bar
    for ($i = 0; $i < $n; ++$i) {
        $trappedWater += min($leftMax[$i], $rightMax[$i]) - $height[$i];
    }

    return $trappedWater;
}
