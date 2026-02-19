<?php

function trap($height) {
    $left = new SplStack();
    $right = new SplStack();
    $trappedWater = 0;

    for ($i = 0; $i < count($height); ++$i) {
        while (!$left->isEmpty() && ($height[$left->top()] < $height[$i])) {
            $peakRightIndex = $left->pop();
            if (!$right->isEmpty()) {
                $leftHeight = $right->top();
            } else {
                $leftHeight = 0;
            }

            $width = $i - $peakRightIndex - 1;
            $trappedWater += max(0, min($height[$peakRightIndex], $leftHeight) * $width);
        }

        $right->push($i);
    }

    while (!$left->isEmpty()) {
        $peakRightIndex = $left->pop();
        if (!$right->isEmpty()) {
            $rightPeakIndex = $right->top();
        } else {
            $rightPeakIndex = count($height);
        }

        $width = $rightPeakIndex - $peakRightIndex - 1;
        $trappedWater += max(0, min($height[$peakRightIndex], 0) * $width);
    }

    return $trappedWater;
}
