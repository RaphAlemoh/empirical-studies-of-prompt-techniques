<?php

function trap(array $height): int {
    $n = count($height);
    if ($n < 3) return 0;

    $leftMax = new SplMaxHeap();
    $rightMax = new SplMinHeap();
    $leftMax->insert($height[0]);
    $trappedWater = 0;

    for ($i = 1; $i < $n; ++$i) {
        $rightMax->insert($height[$i]);
        $currHeight = min($leftMax->getCurrent(), $rightMax->getCurrent());
        if ($height[$i] < $currHeight) {
            $trappedWater += $currHeight - $height[$i];
        } else {
            $leftMax->remove($height[$i - 1]);
        }
    }

    return $trappedWater;
}
