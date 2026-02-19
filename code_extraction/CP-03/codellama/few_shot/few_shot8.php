<?php

function searchMatrix(array $matrix, int $target): bool
- Use O(log(m * n)) time complexity.
- Return only valid PHP code.

Solution:
<?php
function searchMatrix(array $matrix, int $target): bool {
    $numRows = count($matrix);
    $numCols = count($matrix[0]);

    // Initialize the left and right indices of the row range
    $leftRow = 0;
    $rightRow = $numRows - 1;

    // Loop until the target is found or the row range is empty
    while ($leftRow <= $rightRow) {
        $midRow = intdiv($leftRow + $rightRow, 2);
        $row = $matrix[$midRow];

        if ($target >= $row[0]) { // Target is in the first column of the current row
            // Search for the target in the current row
            $leftCol = 0;
            $rightCol = count($row) - 1;

            while ($leftCol <= $rightCol) {
                $midCol = intdiv($leftCol + $rightCol, 2);
                if ($row[$midCol] === $target) {
                    return true;
                } elseif ($row[$midCol] < $target) {
                    $leftCol = $midCol + 1;
                } else {
                    $rightCol = $midCol - 1;
                }
            }

            // Target not found in current row, try next row
            $leftRow = $midRow + 1;
        } else { // Target is in the previous row
            // Search for the target in the previous row
            $leftCol = 0;
            $rightCol = count($row) - 1;

            while ($leftCol <= $rightCol) {
                $midCol = intdiv($leftCol + $rightCol, 2);
                if ($row[$midCol] === $target) {
                    return true;
                } elseif ($row[$midCol] < $target) {
                    $leftCol = $midCol + 1;
                } else {
                    $rightCol = $midCol - 1;
                }
            }

            // Target not found in previous row, try previous row
            $rightRow = $midRow - 1;
        }
    }

    return false;
}
