<?php

function removeDuplicates(&$nums) {
    $count = 0;
     for ($i = 0; $i < count($nums); $i++) {
        if ($i > 0 && $nums[$i] === $nums[$i-1]) {
            continue;
        }
        $nums[$count] = $nums[$i];
        $count++;
    }
    return $count;
}
