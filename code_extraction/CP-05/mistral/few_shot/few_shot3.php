<?php

function trap(array $height): int {
    $n = count($height);
    if ($n <= 1) return 0;

    // Initialize left and right max height arrays
    $leftMax = [$height[0]];
    $rightMax = [];

    for ($i = 1; $i < $n; ++$i) {
        $leftMax[] = max($leftMax[$i - 1], $height[$i]);
    }

    for ($i = $n - 1; $i >= 0; --$i) {
        $rightMax[$i] = max($rightMax[$i + 1] ?? PHP_INT_MAX, $height[$i]);
    }

    // Calculate trapped water and return the total units
    $water = 0;
    for ($i = 0; $i < $n; ++$i) {
        $water += min($leftMax[$i], $rightMax[$i]) - $height[$i];
    }

    return $water;
}
