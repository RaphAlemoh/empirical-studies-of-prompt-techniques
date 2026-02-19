<?php

function searchMatrix(array $matrix, int $target): bool {
    $rowCount = count($matrix);
    $colCount = count($matrix[0]);

    // Convert the 2D matrix to a 1D binary search space
    $flatMatrix = array_merge(...$matrix);

    // Perform a binary search on the flattened matrix
    return (binarySearch($flatMatrix, $target) !== false);
}
