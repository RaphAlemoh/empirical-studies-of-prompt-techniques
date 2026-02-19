<?php

function removeDuplicates(&$nums) {
    $unique = [];
    $pos = 0;

    for ($i = 0; $i < count($nums); $i++) {
        if (!in_array($nums[$i], $unique)) {
            $unique[] = $nums[$i];
            $nums[$pos++] = $nums[$i];
        }
    }

    return $pos;
}
