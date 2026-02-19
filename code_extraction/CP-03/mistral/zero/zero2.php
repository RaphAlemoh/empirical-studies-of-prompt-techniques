<?php

function searchMatrix(array $matrix, int $target): bool {
    if (empty($matrix)) return false;

    $rows = count($matrix);
    $cols = count($matrix[0]);

    $left = 0;
    $right = $rows - 1;

    while ($left <= $right) {
        $mid = floor(($left + $right) / 2);
        $curRow = $matrix[$mid];
        $start = 0;
        $end = $cols - 1;

        while ($start <= $end) {
            $midCol = floor(($start + $end) / 2);
            if ($curRow[$midCol] === $target) return true;
            if ($curRow[$midCol] < $target) $start = $midCol + 1;
            else $end = $midCol - 1;
        }

        if ($target < $matrix[$mid][0]) {
            $right = $mid - 1;
        } else {
            $left = $mid + 1;
        }
    }

    return false;
}
