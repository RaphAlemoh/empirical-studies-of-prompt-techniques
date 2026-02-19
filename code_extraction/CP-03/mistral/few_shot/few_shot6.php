<?php

function searchMatrix(array $matrix, int $target): bool {
    if (empty($matrix)) {
        return false;
    }

    // Find the right starting row index based on the first element of each row
    $row = 0;
    while ($row < count($matrix) && $matrix[$row][0] > $target) {
        $row++;
    }

    // If the target is smaller than all elements in the matrix, return false
    if ($row == count($matrix)) {
        return false;
    }

    // Perform binary search within the selected row
    return binarySearch($matrix[$row], $target);
}
