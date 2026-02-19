<?php

function searchMatrix(array $matrix, int $target): bool {
    $rows = count($matrix);
    if ($rows === 0) return false;

    // Find the first row where the target can be in
    $left = 0;
    $right = $rows - 1;
    while ($left < $right) {
        $mid = intdiv($left + $right, 2);
        if ($matrix[$mid][0] > $target) {
            $right = $mid;
        } else {
            $left = $mid + 1;
        }
    }

    // If the target is not in the found row or exceeds the last row, return false
    if ($target > $matrix[$right][count($matrix[$right]) - 1] || $rows === $right + 1) {
        return false;
    }

    // Perform a binary search in the identified row
    $start = 0;
    $end = count($matrix[$right]) - 1;
    while ($start <= $end) {
        $mid = intdiv($start + $end, 2);
        if ($matrix[$right][$mid] === $target) {
            return true;
        } elseif ($matrix[$right][$mid] < $target) {
            $start = $mid + 1;
        } else {
            $end = $mid - 1;
        }
    }

    // If the target is not found, return false
    return false;
}
