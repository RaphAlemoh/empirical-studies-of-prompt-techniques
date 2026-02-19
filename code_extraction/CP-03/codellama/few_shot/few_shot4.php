<?php

function searchMatrix(array $matrix, int $target): bool {
    $m = count($matrix);
    $n = count($matrix[0]);
    
    // Initialize left and right pointers for each row
    $left = array_fill(0, $m, 0);
    $right = array_fill(0, $m, $n - 1);
    
    while ($left !== null && $right !== null) {
        // Check if the target exists in the current row
        for ($i = 0; $i < $m; $i++) {
            if ($matrix[$i][$left[$i]] === $target || $matrix[$i][$right[$i]] === $target) {
                return true;
            }
        }
        
        // If the target is not found in the current row, update the left and right pointers
        for ($i = 0; $i < $m; $i++) {
            if ($matrix[$i][$left[$i]] > $target) {
                $left[$i]++;
            } else {
                $right[$i]--;
            }
        }
    }
    
    return false;
}
