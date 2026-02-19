<?php

function removeDuplicates(&$nums) {
    $i = 0;
    $length = count($nums);

    for ($j = 1; $j < $length; $j++) {
        if ($nums[$i] !== $nums[$j]) {
            $i++;
            $nums[$i] = $nums[$j];
        }
    }

    return $i + 1;
}
