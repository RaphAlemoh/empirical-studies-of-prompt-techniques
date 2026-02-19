<?php

function trap($height) {
    $n = count($height);
    $leftMax = [0];
    $rightMax = [$n - 1];

    for ($i = 1; $i < $n; ++$i) {
        $leftMax[$i] = max($leftMax[$i - 1], $height[$i - 1]);
    }

    for ($i = $n - 2; $i >= 0; --$i) {
        $rightMax[$i] = max($rightMax[$i + 1], $height[$i + 1]);
    }

    $trappedWater = 0;
    for ($i = 0; $i < $n; ++$i) {
        $trappedWater += min($leftMax[$i], $rightMax[$i]) - $height[$i];
    }

    return $trappedWater;
}
