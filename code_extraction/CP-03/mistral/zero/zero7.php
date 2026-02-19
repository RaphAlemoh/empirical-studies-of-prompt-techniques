<?php

function searchMatrix(array $matrix, int $target): bool {
    $m = count($matrix);
    if ($m === 0) return false;

    $n = count($matrix[0]);
    $i = $m - 1;
    $j = $n - 1;

    while ( $i >= 0 && $j >= 0 ) {
        $current = $matrix[$i][$j];

        if ($current === $target) return true;
        else if ($current < $target) $i--;
        else $j--;
    }

    return false;
}
