<?php

function mergeKLists($lists) {
    $n = count($lists);
    if ($n <= 1) return isset($lists[0]) ? $lists[0] : null;

    $mid = floor($n / 2);
    $left = array_slice($lists, 0, $mid);
    $right = array_slice($lists, $mid);

    return merge(mergeKLists($left), mergeKLists($right));
}
