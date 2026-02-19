<?php

function removeDuplicates(&$nums) {
    $k = 0;
    for ($i = 1; $i < count($nums); $i++) {
        if ($nums[$i] !== $nums[$k]) {
            $nums[$k + 1] = $nums[$i];
            $k++;
        }
    }
    return $k + 1;
}
