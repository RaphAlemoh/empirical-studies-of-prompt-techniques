<?php

function searchMatrix($matrix, $target) {
    if (empty($matrix)) return false;

    $rows = count($matrix);
    $cols = count($matrix[0]);
    $row_start = 0;
    $row_end = $rows - 1;

    while ($row_start <= $row_end) {
        $mid_row = floor(($row_start + $row_end) / 2);
        $mid_col = $cols - 1; // start from the rightmost column since the row is sorted in non-decreasing order

        if ($matrix[$mid_row][$mid_col] === $target) return true;
        if ($matrix[$mid_row][$mid_col] < $target) {
            $row_start = $mid_row + 1; // move to the next row since we are looking for a larger value
        } else {
            $row_end = $mid_row - 1; // move to the previous row since we are looking for a smaller value
        }
    }

    return false; // if we exhaust all rows and didn't find the target, return false
}
