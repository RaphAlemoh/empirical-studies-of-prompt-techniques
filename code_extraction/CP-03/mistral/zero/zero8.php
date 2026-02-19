<?php

function searchMatrix($matrix, $target) {
    $m = count($matrix);
    if ($m === 0) return false;

    $left = 0;
    $right = $m * $matrix[0]->size();

    while ($left < $right) {
        $mid = floor(($left + $right) / 2);
        $rowIndex = intval($mid / $matrix[0]->size());
        $colIndex = $mid % $matrix[0]->size();

        if ($target === $matrix[$rowIndex][$colIndex]) {
            return true;
        }

        // If the target is greater than the current element, we search in the second half of the matrix
        if ($matrix[$rowIndex][$colIndex] < $target) {
            $left = $mid + 1;
        } else {
            $right = $mid;
        }
    }

    return false;
}
