<?php

function removeDuplicates(&$nums) {
    $pos = 0;
    for ($i = 1; $i < count($nums); $i++) {
        if ($nums[$i] != $nums[$pos]) {
            $pos++;
            $nums[$pos] = $nums[$i];
        }
    }
    return $pos + 1;
}
