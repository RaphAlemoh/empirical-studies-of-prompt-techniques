<?php

function searchMatrix($matrix, $target) {
    // Find the row that contains the target
    for ($i = 0; $i < count($matrix); $i++) {
        if (count($matrix[$i]) == 0) continue;
        $row = $matrix[$i];
        $first = $row[0];
        $last = end($row);
        if ($target >= $first && $target <= $last) {
            // Check if the target exists in the row
            foreach ($row as $val) {
                if ($val == $target) return true;
            }
        } elseif ($target < $first) {
            // If the target is smaller than the first element of the row, then it doesn't exist in the matrix
            break;
        }
    }

    return false;
}
