<?php

function trap($height) {
    $trapped = 0;
    $left = [0];
    $right = [];

    // Initialize left stack
    for ($i = 0; $i < count($height); $i++) {
        $index = count($left) - 1;
        while (isset($left[$index]) && $height[$i] <= $height[$left[$index]]) {
            array_pop($left);
        }
        $left[] = $i;
    }

    // Initialize right stack
    for ($i = count($height) - 1; $i >= 0; $i--) {
        $index = count($right);
        while (isset($right[$index]) && $height[$i] <= $height[$right[$index]]) {
            array_push($right, $i);
        }
        $right[] = $i;
    }

    // Calculate trapped water
    for ($i = 0; $i < count($height); $i++) {
        if (isset($left[$i]) && isset($right[$i + 1])) {
            $trapped += min(array_slice($height, $left[$i], $right[$i + 1] - $left[$i])) * ($right[$i + 1] - $left[$i] - 1);
        }
    }

    return $trapped;
}
