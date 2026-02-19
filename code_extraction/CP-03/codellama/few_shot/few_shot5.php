<?php

function searchMatrix($matrix, $target) {
    $m = count($matrix);
    $n = count($matrix[0]);

    // find the first row where the target exists
    for ($i = 0; $i < $m; $i++) {
        if (binarySearch($matrix[$i], $target)) {
            return true;
        }
    }

    return false;
}
