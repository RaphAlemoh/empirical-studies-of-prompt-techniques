<?php

function searchMatrix(array $matrix, int $target): bool {
    $m = count($matrix);
    $n = count($matrix[0]);

    // Check if the first element of the matrix is greater than or equal to the target
    if ($matrix[0][0] >= $target) {
        for ($i = 0; $i < $m; $i++) {
            if ($matrix[$i][0] === $target) {
                return true;
            }
        }
    } else {
        // Perform a binary search on the first column of the matrix to find the target
        $left = 0;
        $right = $n - 1;

        while ($left <= $right) {
            $mid = intdiv($left + $right, 2);
            if ($matrix[0][$mid] === $target) {
                return true;
            } elseif ($matrix[0][$mid] < $target) {
                $left = $mid + 1;
            } else {
                $right = $mid - 1;
            }
        }
    }

    return false;
}
