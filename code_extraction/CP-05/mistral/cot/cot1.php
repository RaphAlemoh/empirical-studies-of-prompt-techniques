<?php

function trap(array $height) {
    $left = array_flip($height);
    $right = array_reverse($height, true);
    $right = array_flip($right);

    $trappedWater = 0;
    for ($i = 0; $i < count($height); $i++) {
        $leftHeight = isset($left[$i]) ? $left[$i] : 0;
        $rightHeight = isset($right[$i + 1]) ? $right[$i + 1] : 0;
        $currentHeight = $height[$i];

        $waterLevel = min($leftHeight, $rightHeight);
        if ($waterLevel > $currentHeight) {
            $trappedWater += $waterLevel - $currentHeight;
        }
    }

    return $trappedWater;
}
