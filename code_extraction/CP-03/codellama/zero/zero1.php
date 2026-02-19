<?php

function searchMatrix(array $matrix, int $target): bool {
    $m = count($matrix);
    $n = count($matrix[0]);

    $top = 0;
    $bottom = $m * $n - 1;

    while ($top <= $bottom) {
        $mid = floor(($top + $bottom) / 2);
        $row = (int) ($mid / $n);
        $col = $mid % $n;

        if ($matrix[$row][$col] >= $target) {
            // check if the target value is greater than or equal to the previous element in the row
            if ($col > 0 && $matrix[$row][$col - 1] <= $target) {
                return true;
            }

            // move right
            $top = $mid + 1;
        } else {
            // check if the target value is less than or equal to the current element in the row
            if ($matrix[$row][$col] <= $target) {
                return true;
            }

            // move down
            $bottom = $mid - 1;
        }
    }

    return false;
}
