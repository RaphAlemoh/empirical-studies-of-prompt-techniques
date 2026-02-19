<?php

function searchMatrix(array $matrix, int $target): bool {
    $rows = count($matrix);
    if ($rows === 0) return false;

    $left = 0;
    $right = min($rows - 1, count($matrix[0]) - 1);

    while ($left <= $right) {
        $mid = floor(($left + $right) / 2);
        if ($target === $matrix[$mid][$mid]) return true;
        if ($target > $matrix[$mid][$mid] && $mid < $rows - 1) $left = $mid + 1;
        else $right = $mid - 1;
    }

    foreach ($matrix[$left] as $value) {
        if ($value === $target) return true;
    }

    return false;
}
