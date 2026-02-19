<?php

function trap(array $height): int {
    $leftMax = [];
    $rightMax = [];
    $total = 0;
    for ($i = 0; $i < count($height); $i++) {
        $leftMax[$i] = 0;
        $rightMax[$i] = 0;
    }
    for ($i = 1; $i < count($height) - 1; $i++) {
        $leftMax[$i] = max($leftMax[$i - 1], $height[$i - 1]);
        $rightMax[$i] = max($rightMax[$i + 1], $height[$i + 1]);
    }
    for ($i = 1; $i < count($height) - 1; $i++) {
        $total += min($leftMax[$i], $rightMax[$i]) - $height[$i];
    }
    return $total;
}
