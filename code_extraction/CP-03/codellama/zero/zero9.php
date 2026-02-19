<?php

function searchMatrix(array $matrix, int $target): bool {
    // Calculate the dimensions of the matrix
    $m = count($matrix);
    $n = count($matrix[0]);

    // Initialize variables for the binary search
    $low = 0;
    $high = $m * $n - 1;
    $mid = ($low + $high) / 2;

    // Perform the binary search
    while ($low <= $high) {
        if ($matrix[$mid / $n][$mid % $n] == $target) {
            return true;
        } elseif ($matrix[$mid / $n][$mid % $n] < $target) {
            $low = $mid + 1;
        } else {
            $high = $mid - 1;
        }
        $mid = ($low + $high) / 2;
    }

    // If the search ends, return false if the target was not found
    return false;
}
