<?php

function searchMatrix(array $matrix, int $target): bool {
    // Convert the 2D matrix to a 1D binary search space
    $flattened = array_merge(...$matrix);
    $low = 0;
    $high = count($flattened) - 1;

    while ($low <= $high) {
        $mid = (int)(($low + $high) / 2);
        if ($flattened[$mid] === $target) {
            return true;
        } elseif ($flattened[$mid] > $target) {
            $high = $mid - 1;
        } else {
            $low = $mid + 1;
        }
    }
    return false;
}
