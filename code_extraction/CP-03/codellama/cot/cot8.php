<?php

function searchMatrix(array $matrix, int $target): bool {
    $rows = count($matrix);
    $cols = count($matrix[0]);
    for ($i = 0; $i < $rows; $i++) {
        if (binarySearch($matrix[$i], $target)) {
            return true;
        }
    }
    return false;
}
