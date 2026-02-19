<?php

function trap(array $height): int
{
	$leftMax = [];
	$rightMax = [];
	$total = 0;

	for ($i = 0; $i < count($height); $i++) {
		$leftMax[$i] = max($leftMax[$i - 1], $height[$i]);
	}

	for ($i = count($height) - 2; $i >= 0; $i--) {
		$rightMax[$i] = max($rightMax[$i + 1], $height[$i]);
	}

	for ($i = 0; $i < count($height); $i++) {
		$total += min($leftMax[$i], $rightMax[$i]) - $height[$i];
	}

	return $total;
}
