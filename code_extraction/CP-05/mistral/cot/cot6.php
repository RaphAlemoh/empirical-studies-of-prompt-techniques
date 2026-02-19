<?php

function trap(array $height): int {
    $left = array_fill(0, count($height), 0);
    $right = array_fill(0, count($height), 0);

    for ($i = 1; $i < count($height); $i++) {
        $left[$i] = max($left[$i - 1], $height[$i - 1]);
    }

    for ($i = count($height) - 2; $i >= 0; $i--) {
        $right[$i] = max($right[$i + 1], $height[$i + 1]);
    }

    $trappedWater = 0;
    for ($i = 0; $i < count($height); $i++) {
        $trappedWater += min($left[$i], $right[$i]) - $height[$i];
    }

    return $trappedWater;
}
