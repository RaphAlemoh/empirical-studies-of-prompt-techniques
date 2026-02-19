<?php

function searchMatrix(array $matrix, int $target): bool {
	// get the dimensions of the matrix
	$m = count($matrix);
	$n = count($matrix[0]);

	// loop through the matrix in a spiral pattern
	for ($i = 0, $j = 0; $i < $m && $j < $n;) {
		// check if the current element is equal to the target
		if ($matrix[$i][$j] == $target) {
			return true;
		}

		// move to the next element in the spiral pattern
		$nextI = $i + 1;
		$nextJ = $j + 1;

		// check if we need to wrap around horizontally or vertically
		if ($nextI >= $m || $matrix[$nextI][$j] > $target) {
			$j++;
		} else if ($nextJ >= $n || $matrix[$i][$nextJ] > $target) {
			$i++;
		} else {
			$i = $nextI;
			$j = $nextJ;
		}
	}

	// if we reach the end of the matrix without finding the target, return false
	return false;
}
