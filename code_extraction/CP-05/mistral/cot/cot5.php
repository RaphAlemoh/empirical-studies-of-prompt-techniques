<?php

function trap(array $height): int {
    $maxLeft = [];
    $maxRight = [];
    $result = 0;

    $leftMax = $rightMax = PHP_INT_MIN;

    foreach (array_reverse($height) as $i => $val) {
        $rightMax = max($rightMax, $val);
        $maxRight[$i] = $rightMax;
    }

    $leftMax = $height[0];

    foreach ($height as $i => $val) {
        $result += min($leftMax, $rightMax[$i]) - $val;
        $leftMax = max($leftMax, $val);
    }

    return $result;
}
