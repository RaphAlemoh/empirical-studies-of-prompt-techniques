<?php

function removeDuplicates(&$nums) {
    $pos = 0;
    for ($i = 1; $i < count($nums); $i++) {
        if ($nums[$i] !== $nums[$pos - 1]) {
            $nums[$pos] = $nums[$i];
            $pos++;
        }
    }
    return $pos;
}
