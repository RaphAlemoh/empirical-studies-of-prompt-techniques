<?php

function searchMatrix(array $matrix, int $target): bool {
    if (empty($matrix)) return false;

    // Find the starting and ending rows
    $left = 0;
    $right = count($matrix) - 1;

    while ($left <= $right) {
        $mid = intdiv($left + $right, 2);
        if ($matrix[$mid][0] > $target) {
            $right = $mid - 1;
        } else {
            $left = $mid + 1;
        }
    }

    // If the target is out of bounds, it's not in the matrix
    if ($left >= count($matrix)) return false;

    // Perform binary search within the found row
    $row = $matrix[$left];
    $low = 0;
    $high = count($row) - 1;

    while ($low <= $high) {
        $mid = intdiv($low + $high, 2);

        if ($row[$mid] === $target) return true;
        elseif ($row[$mid] < $target) $low = $mid + 1;
        else $high = $mid - 1;
    }

    // If the target is not found within the row, it's not in the matrix
    return false;
}
