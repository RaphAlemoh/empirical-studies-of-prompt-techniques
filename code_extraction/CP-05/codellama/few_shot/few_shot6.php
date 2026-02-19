<?php

function trap(array $height): int {
    $max_water = 0;

    for ($i = 1; $i < count($height) - 1; $i++) {
        $left = max($height[$i - 1], $height[$i]);
        $right = max($height[$i + 1], $height[$i]);
        $max_water += min($left, $right) - $height[$i];
    }

    return $max_water;
}
