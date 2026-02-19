<?php

function trap(array $height): int {
    $total = 0;
    for ($i = 1; $i < count($height) - 1; $i++) {
        $leftMax = max(0, $height[$i - 1]);
        $rightMax = max(0, $height[$i + 1]);
        $currentBarHeight = min($leftMax, $rightMax);
        $waterTrapped = ($currentBarHeight - $height[$i]) * 2;
        if ($waterTrapped > 0) {
            $total += $waterTrapped;
        }
    }
    return $total;
}
