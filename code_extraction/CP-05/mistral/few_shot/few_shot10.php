<?php

function trap(array $height): int {
    $n = count($height);
    $leftMax = array_fill(0, $n, 0);
    $rightMax = array_fill(0, $n, 0);

    // First pass: compute left and right maximum heights for each element
    for ($i = 1; $i < $n; ++$i) {
        $leftMax[$i] = max($leftMax[$i - 1], $height[$i - 1]);
    }

    for ($i = $n - 2; $i >= 0; --$i) {
        $rightMax[$i] = max($rightMax[$i + 1], $height[$i + 1]);
    }

    // Second pass: calculate the trapped water by subtracting the minimum between left and right heights for each element
    $totalTrappedWater = 0;
    for ($i = 0; $i < $n; ++$i) {
        $trappedWater = min($leftMax[$i], $rightMax[$i]) - $height[$i];
        if ($trappedWater > 0) {
            $totalTrappedWater += $trappedWater;
        }
    }

    return $totalTrappedWater;
}
