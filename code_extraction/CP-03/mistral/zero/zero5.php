<?php

function searchMatrix($matrix, $target) {
    $rows = count($matrix);
    if ($rows === 0) return false;

    $left = 0;
    $right = $rows - 1;

    while ($left <= $right) {
        $mid = floor(($left + $right) / 2);

        $firstInCurrentRow = $matrix[$mid];
        $lastInPreviousRow = $mid > 0 ? $matrix[$mid - 1] : null;

        if ($target === $firstInCurrentRow) {
            return true;
        }

        if (is_null($lastInPreviousRow) || $target > $firstInCurrentRow) {
            $left = $mid + 1;
        } else {
            $right = $mid - 1;
        }
    }

    return false;
}
