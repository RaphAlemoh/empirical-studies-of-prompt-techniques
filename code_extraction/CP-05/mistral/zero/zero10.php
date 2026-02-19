<?php

function trap($height) {
    $n = count($height);
    $result = 0;
    $left = 0;
    $right = $n - 1;

    // Continue until both pointers meet
    while ($left < $right) {
        // Find the minimum between left and right heights, and their respective indices
        $min_height = min($height[$left], $height[$right]);
        $left_index = $right_index = null;
        if ($height[$left] == $min_height) {
            $left_index = $left;
        }
        if ($height[$right] == $min_height) {
            $right_index = $right;
        }

        // Move the pointer with higher height towards the other one to increase trapped water
        if ($height[$left] < $height[$right]) {
            $left++;
        } else {
            $right--;
        }

        // Calculate and accumulate the amount of trapped water between the two pointers
        if (!is_null($left_index) && !is_null($right_index)) {
            $distance = abs($left_index - $right_index);
            $trapped = $min_height * $distance;
            $result += $trapped;
        }
    }

    return $result;
}
