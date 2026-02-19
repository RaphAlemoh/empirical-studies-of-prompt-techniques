<?php

function trap($height)
{
    $left = 0;
    $right = count($height);
    $maxHeightLeft = $height[$left];
    $maxHeightRight = $height[$right];
    $water = 0;
    while ($left < $right) {
        if ($maxHeightLeft < $maxHeightRight) {
            $left++;
            if ($height[$left] < $maxHeightLeft) {
                $water += $maxHeightLeft - $height[$left];
            } else {
                $maxHeightLeft = $height[$left];
            }
        } else {
            $right--;
            if ($height[$right] < $maxHeightRight) {
                $water += $maxHeightRight - $height[$right];
            } else {
                $maxHeightRight = $height[$right];
            }
        }
    }
    return $water;
}