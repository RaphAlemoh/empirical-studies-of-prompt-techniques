<?php

function searchMatrix($matrix, $target) {
    // Get the dimensions of the matrix
    $rows = count($matrix);
    $cols = count($matrix[0]);
    
    // Initialize variables to keep track of the search bounds
    $startRow = 0;
    $endRow = $rows - 1;
    $startCol = 0;
    $endCol = $cols - 1;
    
    // Loop until we find the target or reach the end of the matrix
    while ($startRow <= $endRow && $startCol <= $endCol) {
        // Get the current row and column that we are searching in
        $row = floor(($startRow + $endRow) / 2);
        $col = floor(($startCol + $endCol) / 2);
        
        // Check if the target is less than or equal to the element at the current position
        if ($target <= $matrix[$row][$col]) {
            // If the target is less than the element, we know it must be in the upper half
            $endRow = $row - 1;
            
            // If the target is greater than the element, we know it must be in the lower half
        } elseif ($target > $matrix[$row][$col]) {
            $startRow = $row + 1;
        }
        
        // Check if we have found the target
        if ($matrix[$row][$col] == $target) {
            return true;
        }
    }
    
    // If we reach the end of the matrix without finding the target, return false
    return false;
}
