<?php

function trap(array $height): int {
    $n = count($height);
    if ($n <= 1) return 0;

    $leftMax = new SplMinHeap();
    $rightMax = new SplMaxHeap();

    $leftMax->insert($height[0]);
    $trappedWater = 0;

    for ($i = 1; $i < $n; ++$i) {
        // Insert the current height on the right max heap and update the left max if necessary.
        $rightMax->insert($height[$i]);
        while ($leftMax->current() < $height[$i]) {
            $cur = $leftMax->extractMin();
            if ($rightMax->current() > $cur) {
                $trappedWater += ($cur - $leftMax->current()) * (($i - $leftMax->count()) - 1);
            }
        }
        $leftMax->insert($height[$i]);
    }

    // Process the remaining part on the right side.
    while ($leftMax->count() > 0) {
        $cur = $leftMax->extractMin();
        if ($rightMax->count() > 0 && $cur > $rightMax->current()) {
            $trappedWater += ($cur - $rightMax->current()) * ($n - $leftMax->count());
        }
    }

    return $trappedWater;
}
