<?php

function searchMatrix(array $matrix, int $target): bool {
    // Initialize variables for the binary search algorithm
    $low = 0;
    $high = count($matrix) - 1;
    $mid = ($low + $high) / 2;

    // Search through the rows of the matrix using a binary search
    while ($low <= $high) {
        // Check if the current row contains the target
        if (in_array($target, $matrix[$mid])) {
            return true;
        }

        // If the target is not found in the current row, move to the next row
        $mid = ($low + $high) / 2;
    }

    // If the target is not found in any of the rows, return false
    return false;
}
