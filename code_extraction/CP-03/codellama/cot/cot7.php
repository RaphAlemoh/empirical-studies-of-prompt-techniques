<?php

function searchMatrix($matrix, $target) {
    $rowCount = count($matrix);
    $colCount = count($matrix[0]);
    $low = 0;
    $high = $rowCount * $colCount - 1;
    
    while ($low <= $high) {
        $mid = floor(($low + $high) / 2);
        $currentRow = floor($mid / $colCount);
        $currentCol = $mid % $colCount;
        if ($matrix[$currentRow][$currentCol] == $target) {
            return true;
        } elseif ($matrix[$currentRow][$currentCol] < $target) {
            $low = $mid + 1;
        } else {
            $high = $mid - 1;
        }
    }
    
    return false;
}
