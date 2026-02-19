<?php

function removeDuplicates(&$nums) {
    $count = 0;
    for ($i = 1; $i < count($nums); $i++) {
        if ($nums[$i] != $nums[$count]) {
            $count++;
            $nums[$count] = $nums[$i];
        }
    }
    return $count + 1;
}
