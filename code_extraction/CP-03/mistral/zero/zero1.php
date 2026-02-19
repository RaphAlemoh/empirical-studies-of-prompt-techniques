<?php

function searchMatrix($matrix, $target) {
    $m = count($matrix);
    if ($m === 0) return false;

    $n = count($matrix[0]);
    $left = 0;
    $right = $m * $n - 1;

    while ($left <= $right) {
        $mid = floor(($left + $right) / 2);
        $row = intval($mid / $n);
        $col = $mid % $n;

        if ($matrix[$row][$col] === $target) {
            return true;
        }

        if ($matrix[$row][$col] < $target) {
            $left = $mid + 1;
        } else {
            $right = $mid - 1;
        }
    }

    return false;
}
