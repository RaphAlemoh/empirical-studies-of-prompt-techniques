<?php

function trap(array $height): int {
    $n = count($height);
    $left = array_fill(0, $n, 0);
    $right = array_fill(0, $n, 0);

    $maxLeft = $maxRight = 0;

    for ($i = 1; $i < $n; $i++) {
        $left[$i] = max($left[$i - 1], $height[$i - 1]);
        $maxLeft = max($maxLeft, $left[$i]);
    }

    for ($i = $n - 2; $i >= 0; $i--) {
        $right[$i] = max($right[$i + 1], $height[$i + 1]);
        $maxRight = max($maxRight, $right[$i]);
    }

    $volume = 0;
    for ($i = 0; $i < $n; $i++) {
        $volume += min($left[$i], $right[$i]) - $height[$i];
    }

    return $volume;
}
