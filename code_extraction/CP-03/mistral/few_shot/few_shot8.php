<?php

function searchMatrix(array $matrix, int $target): bool {
    $m = count($matrix);
    $left = 0;
    $right = $m - 1;

    while ($left <= $right) {
        $midRow = intdiv($left + $right, $m);
        $startCol = 0;
        $endCol = count($matrix[$midRow]) - 1;

        while ($startCol <= $endCol) {
            $midCol = intdiv($startCol + $endCol, 2);

            if ($matrix[$midRow][$midCol] === $target) {
                return true;
            } elseif ($matrix[$midRow][$midCol] < $target) {
                $startCol = $midCol + 1;
            } else {
                $endCol = $midCol - 1;
            }
        }

        if ($matrix[$midRow][$endCol] >= $target) {
            $right = $midRow - 1;
        } else {
            $left = $midRow + 1;
        }
    }

    return false;
}
