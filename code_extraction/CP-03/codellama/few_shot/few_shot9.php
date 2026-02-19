<?php

function searchMatrix($matrix, $target) {
    $rows = count($matrix);
    $cols = count($matrix[0]);
    $left = 0;
    $right = $rows * $cols - 1;

    while ($left <= $right) {
        $mid = intdiv($left + $right, 2);
        $row = floor(($mid / $cols));
        $col = $mid % $cols;
        if ($matrix[$row][$col] == $target) {
            return true;
        } elseif ($matrix[$row][$col] < $target) {
            $left = $mid + 1;
        } else {
            $right = $mid - 1;
        }
    }

    return false;
}
