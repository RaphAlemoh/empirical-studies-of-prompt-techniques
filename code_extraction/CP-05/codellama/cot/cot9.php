<?php

function trap($height) {
    $leftMax = [];
    $rightMax = [];
    $total = 0;

    for ($i = 0; $i < count($height); $i++) {
        $leftMax[$i] = $i == 0 ? $height[$i] : max($leftMax[$i - 1], $height[$i]);
    }

    for ($j = count($height) - 1; $j >= 0; $j--) {
        $rightMax[$j] = $j == count($height) - 1 ? $height[$j] : max($rightMax[$j + 1], $height[$j]);
    }

    for ($i = 0; $i < count($height); $i++) {
        $total += min($leftMax[$i], $rightMax[$i]) - $height[$i];
    }

    return $total;
}
