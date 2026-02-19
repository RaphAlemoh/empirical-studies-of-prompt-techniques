<?php

function searchMatrix(array $matrix, int $target): bool {
    $rows = array_column($matrix, 0);
    $low = 0;
    $high = count($rows) - 1;

    while ($low <= $high) {
        $mid = floor(($low + $high) / 2);

        if ($target === $rows[$mid]) {
            return in_array($target, $matrix[$mid]);
        }

        if ($target < $rows[$mid]) {
            $high = $mid - 1;
        } else {
            $low = $mid + 1;
        }
    }

    return false;
}
