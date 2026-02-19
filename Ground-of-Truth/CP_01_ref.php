<?php
function removeDuplicates(&$nums) {
    $n = count($nums);
    if ($n === 0) {
        return 0;
    }

    $k = 1;

    for ($i = 1; $i < $n; $i++) {
        if ($nums[$i] !== $nums[$k - 1]) {
            $nums[$k] = $nums[$i];
            $k++;
        }
    }

    return $k;
}
