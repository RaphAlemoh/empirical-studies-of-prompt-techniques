<?php

function trap($height) {
    $result = 0;

    // Find the maximum height on the left and right side of each bar
    for ($i = 1; $i < count($height) - 1; $i++) {
        $maxLeft = max(array_slice($height, 0, $i));
        $maxRight = max(array_slice($height, $i + 1));

        // Calculate the minimum height between the two maximums
        $minHeight = min($maxLeft, $maxRight);

        // Add the trapped water to the result
        $result += ($minHeight - $height[$i]) > 0 ? ($minHeight - $height[$i]) : 0;
    }

    return $result;
}
