<?php

function searchMatrix(array $matrix, int $target): bool {
    $rows = count($matrix);
    $cols = count($matrix[0]);

    // Map the 2D matrix to a 1D binary search space by flattening it into a one-dimensional array
    $flattenedMatrix = [];
    for ($i = 0; $i < $rows; ++$i) {
        $row = $matrix[$i];
        $len = count($row);
        for ($j = 0; $j < $len; ++$j) {
            $flattenedMatrix[] = $row[$j];
        }
    }

    // Perform a binary search on the flattened array to find the target
    $low = 0;
    $high = count($flattenedMatrix) - 1;
    while ($low <= $high) {
        $mid = (int)floor(($low + $high) / 2);
        if ($target === $flattenedMatrix[$mid]) {
            return true;
        } elseif ($target < $flattenedMatrix[$mid]) {
            $high = $mid - 1;
        } else {
            $low = $mid + 1;
        }
    }

    // If the target was not found, return false
    return false;
}
