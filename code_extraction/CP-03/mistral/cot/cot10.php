<?php

function searchMatrix(array $matrix, int $target) {
    $n = count($matrix);
    if ($n === 0) return false;
    $left = 0;
    $right = $n * $matrix[0]->num_rows;

    while ($left < $right) {
        $mid = floor(($left + $right) / 2);
        $midRow = intval($mid / $matrix[0]->num_rows);
        $midVal = $matrix[$midRow][$mid % $matrix[0]->num_rows];

        if ($midVal === $target) return true;
        if ($midVal < $target) $left = $mid + 1;
        else $right = $mid;
    }

    return false;
}
