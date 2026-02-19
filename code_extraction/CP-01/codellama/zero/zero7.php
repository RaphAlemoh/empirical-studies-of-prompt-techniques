<?php

function removeDuplicates(&$nums) {
    $length = count($nums);
    $i = 0;
    for ($j = 1; $j < $length; $j++) {
        if ($nums[$i] !== $nums[$j]) {
            $i++;
            $nums[$i] = $nums[$j];
        }
    }
    return $i + 1;
}
