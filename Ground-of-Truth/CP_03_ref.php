<?php

function searchMatrix($matrix, $target)
{
    if (empty($matrix) || empty($matrix[0])) {
        return false;
    }
    $rows = count($matrix);
    $cols = count($matrix[0]);
    if ($target < $matrix[0][0] || $target > $matrix[$rows - 1][$cols - 1]) {
        return false;
    }
    $left = 0;
    $right = $rows * $cols - 1;
    while ($left <= $right) {
        $mid = $left + intdiv($right - $left, 2);
        $row = intdiv($mid, $cols);
        $col = $mid % $cols;
        $value = $matrix[$row][$col];

        if ($value === $target) {
            return true;
        } elseif ($value < $target) {
            $left = $mid + 1;
        } else {
            $right = $mid - 1;
        }
    }

    return false;
}
