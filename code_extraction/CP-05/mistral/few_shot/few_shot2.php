<?php

function trap(array $height): int {
    $n = count($height);
    if ($n < 3) {
        return 0;
    }

    $leftMax = new SplMinHeap();
    $rightMax = new SplMinHeap();
    $leftMax->insert(array_shift($height));
    $trappedWater = 0;

    for ($i = 1; $i < $n; ++$i) {
        $rightMax->insert($height[$i]);
        $curLeft = $leftMax->extractMin();
        if ($height[$i] > $curLeft) {
            $leftMax->insert($height[$i]);
        } else {
            $trappedWater += max(0, $curLeft - $height[$i]);
        }
    }

    reset($height);
    array_pop($height);

    foreach ($height as $h) {
        $leftMax->insert($h);
        $curRight = $rightMax->extractMin();
        if ($h > $curRight) {
            $rightMax->insert($h);
        } else {
            $trappedWater += max(0, $curRight - $h);
        }
    }

    return $trappedWater;
}
