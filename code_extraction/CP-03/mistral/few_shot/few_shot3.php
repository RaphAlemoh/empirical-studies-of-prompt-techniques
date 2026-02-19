<?php

function searchMatrix(array $matrix, int $target): bool {
    $m = count($matrix);
    if ($m === 0) return false;

    for ($i = 0; $i < $m; $i++) {
        $left = 0;
        $right = count($matrix[$i]) - 1;

        while ($left <= $right) {
            $mid = intdiv($left + $right, 2);
            if ($matrix[$i][$mid] === $target) {
                return true;
            } elseif ($matrix[$i][$mid] < $target) {
                $left = $mid + 1;
            } else {
                $right = $mid - 1;
            }
        }

        if (isset($matrix[$i][$right]) && $matrix[$i][$right] < $target) break;
    }

    return false;
}
