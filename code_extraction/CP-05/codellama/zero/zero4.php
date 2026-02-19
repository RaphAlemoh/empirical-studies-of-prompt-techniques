<?php

function trap(array $heights): int {
        // Find the maximum value in the array to know the highest peak
        $maxHeight = max($heights);
        // Initialize variables for storing the left and right pointers
        $left = 0;
        $right = count($heights) - 1;
        // Initialize a variable to store the total amount of water trapped
        $totalWaterTrapped = 0;
        // Loop through the array from both sides until we reach the middle
        while ($left < $right) {
            // If the height at the left pointer is less than the height at the right pointer, we know that the water at this point will overflow
            if ($heights[$left] < $heights[$right]) {
                // Calculate the amount of water that will overflow and add it to the total amount of water trapped
                $totalWaterTrapped += ($maxHeight - $heights[$left++]);
            } else {
                // If the height at the right pointer is less than the height at the left pointer, we know that the water at this point will overflow
                $totalWaterTrapped += ($maxHeight - $heights[$right--]);
            }
        }
        return $totalWaterTrapped;
    }
