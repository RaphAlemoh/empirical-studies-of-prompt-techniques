<?php

function searchMatrix(array $matrix, int $target): bool {
    $rows = $columns = 0;
    foreach ($matrix as $row) {
        $rows++;
        if (count($row) > $columns) {
            $columns = count($row);
        }
    }

    $left = 0;
    $right = $rows * $columns - 1;

    while ($left <= $right) {
        $mid = intdiv($left + $right, 2);
        $row = intval(floor($mid / $columns));
        $col = $mid % $columns;
        if ($matrix[$row][$col] === $target) {
            return true;
        } elseif ($matrix[$row][$col] < $target) {
            $left = $mid + 1;
        } else {
            $right = $mid - 1;
        }
    }

    return false;
}
