<?php

function removeDuplicates(&$nums) {
    $unique = [];
    $posUnique = 0;
    for ($i = 0; $i < count($nums); $i++) {
        if (!in_array($nums[$i], $unique)) {
            $unique[$posUnique] = $nums[$i];
            $posUnique++;
        }
    }

    for ($i = 0; $i < $posUnique; $i++) {
        $nums[$i] = $unique[$i];
    }

    return $posUnique;
}
