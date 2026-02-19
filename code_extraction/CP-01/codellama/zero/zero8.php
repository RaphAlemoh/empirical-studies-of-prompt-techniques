<?php

function removeDuplicates(&$nums) {
    $unique = 0;
    for ($i=1; $i < count($nums); $i++) {
        if ($nums[$i] !== $nums[$i-1]) {
            $nums[$unique++] = $nums[$i];
        }
    }
    return $unique;
}
