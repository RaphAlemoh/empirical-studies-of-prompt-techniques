<?php

function trap(array $height): int {
    $total = 0;
    $left = array_slice($height, 1);
    $right = array_reverse(array_slice($height, 0, -1));
    for ($i = 0; $i < count($height) - 1; $i++) {
        if ($height[$i] >= $left[$i]) {
            continue;
        }
        if ($height[$i + 1] >= $right[$i]) {
            continue;
        }
        $total += min($left[$i], $right[$i]) - $height[$i];
    }
    return $total;
}
