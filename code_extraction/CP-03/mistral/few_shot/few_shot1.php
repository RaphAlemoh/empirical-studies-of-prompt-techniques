<?php

function searchMatrix(array $matrix, int $target): bool {
    $rows = count($matrix);
    if ($rows == 0) return false;

    // Find the row that potentially contains the target
    $low = 0;
    $high = $rows - 1;
    while ($low < $high) {
        $mid = intdiv($low + $high, 2);
        if ($matrix[$mid][0] > $target) {
            $high = $mid;
        } else {
            $low = $mid + 1;
        }
    }

    // If we haven't found the target yet or the current row index is out of bounds, return false.
    if ($low == $rows || $matrix[$low - 1][$cols - 1] > $target) {
        return false;
    }

    // Perform binary search in the selected row to find the target
    $cols = count($matrix[$low - 1]);
    $left = 0;
    $right = $cols - 1;
    while ($left <= $right) {
        $mid = intdiv($left + $right, 2);
        if ($matrix[$low - 1][$mid] === $target) {
            return true;
        } elseif ($matrix[$low - 1][$mid] < $target) {
            $left = $mid + 1;
        } else {
            $right = $mid - 1;
        }
    }

    // If the target wasn't found, return false
    return false;
}
