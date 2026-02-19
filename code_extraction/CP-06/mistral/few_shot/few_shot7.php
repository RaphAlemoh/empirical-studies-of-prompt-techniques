<?php

function mergeKLists(array $lists) {
    $n = count($lists);
    for ($i = 0; $i < $n; $i++) {
        if (!isset($lists[$i])) {
            throw new Exception('All lists must be provided');
        }
    }

    return mergeSort($lists, 0, $n - 1);
}
