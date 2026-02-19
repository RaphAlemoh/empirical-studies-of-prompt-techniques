<?php

function trap(array $height): int {
    // Calculate the total width of the elevation map
    $width = count($height);
    
    // Initialize variables to keep track of the maximum water trapped on each side
    $leftMax = 0;
    $rightMax = 0;
    
    // Loop through the height array from left to right
    for ($i = 0; $i < $width; $i++) {
        // Update the maximum water trapped on the left side if necessary
        if ($height[$i] > $leftMax) {
            $leftMax = $height[$i];
        }
        
        // Calculate the distance between the current bar and the maximum water trapped on the left side
        $distanceToLeftMax = $leftMax - $height[$i];
        
        // Update the maximum water trapped on the right side if necessary
        if ($height[$width - 1 - $i] > $rightMax) {
            $rightMax = $height[$width - 1 - $i];
        }
        
        // Calculate the distance between the current bar and the maximum water trapped on the right side
        $distanceToRightMax = $rightMax - $height[$width - 1 - $i];
        
        // Add the distance between the current bar and the maximum water trapped on both sides to the total units of trapped water
        $totalUnits += min($distanceToLeftMax, $distanceToRightMax);
    }
    
    // Return the total units of trapped water
    return $totalUnits;
}
