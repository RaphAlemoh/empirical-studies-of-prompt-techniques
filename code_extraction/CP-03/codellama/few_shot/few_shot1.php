<?php

function searchMatrix(array $matrix, int $target): bool {
    $m = count($matrix);
    $n = count($matrix[0]);
    
    // Initialize variables for binary search
    $left = 0;
    $right = $m * $n - 1;
    $mid = intdiv($left + $right, 2);
    
    // Loop until the target is found or the search range is empty
    while ($left <= $right) {
        // Get the current row and column of the pivot element
        $row = floor($mid / $n);
        $col = $mid % $n;
        
        // Check if the target exists in the current row
        if ($matrix[$row][$col] === $target) {
            return true;
        } elseif ($matrix[$row][$col] < $target) {
            // If the pivot element is less than the target, narrow down the search range to the right half
            $left = $mid + 1;
        } else {
            // If the pivot element is greater than the target, narrow down the search range to the left half
            $right = $mid - 1;
        }
        
        // Update the mid index for the next iteration
        $mid = intdiv($left + $right, 2);
    }
    
    return false;
}
