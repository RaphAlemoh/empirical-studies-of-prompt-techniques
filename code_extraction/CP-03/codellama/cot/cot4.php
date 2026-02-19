<?php

function searchMatrix(array $matrix, int $target): bool {
    for ($i = 0; $i < count($matrix); $i++) {
        if (binarySearchRow($matrix[$i], $target)) {
            return true;
        }
    }
    return false;
}
