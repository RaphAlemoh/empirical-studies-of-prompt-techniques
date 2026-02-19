<?php

function searchMatrix(array $matrix, int $target): bool {
    $rows = count($matrix);

    if ($rows === 0) return false;

    // Find the correct row to start the binary search
    for ($i = 0; $i < $rows; $i++) {
        if ($matrix[$i][0] > $target) break;
        if (in_array($target, $matrix[$i])) return true;
    }

    // Perform binary search on the appropriate row
    $left = 0;
    $right = count($matrix[$i]) - 1;

    while ($left <= $right) {
        $mid = intdiv($left + $right, 2);
        if ($matrix[$i][$mid] === $target) {
            return true;
        } elseif ($matrix[$i][$mid] < $target) {
            $left = $mid + 1;
        } else {
            $right = $mid - 1;
        }
    }

    // If the target was not found in the appropriate row, it does not exist in the matrix
    return false;
}
