<?php

function searchMatrix($matrix, $target) {
    $m = count($matrix);
    $n = count($matrix[0]);
    
    // Find the row index containing the target
    for ($i = 0; $i < $m; $i++) {
        if (binarySearch($matrix[$i], $target)) {
            return true;
        }
    }
    
    return false;
}
