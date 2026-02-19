<?php

function trap($height) {
    $n = count($height);
    if ($n == 0) return 0;

    // left and right pointers to keep track of the maximum height
    $leftMax = array_fill(0, $n, 0);
    $rightMax = array_fill(0, $n, 0);

    // initialize left pointer
    for ($i = 1; $i < $n; $i++) {
        $leftMax[$i] = max($height[$i], $leftMax[$i - 1]);
    }

    // initialize right pointer
    for ($i = $n - 2; $i >= 0; $i--) {
        $rightMax[$i] = max($height[$i], $rightMax[$i + 1]);
    }

    // calculate the trapped water
    $trappedWater = 0;
    for ($i = 0; $i < $n; $i++) {
        $trappedWater += min($leftMax[$i], $rightMax[$i]) - $height[$i];
    }

    return $trappedWater;
}
