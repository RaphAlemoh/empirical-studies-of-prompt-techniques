<?php

function mergeKLists($lists) {
    $n = count($lists);
    if ($n <= 1) return $n > 0 ? reset($lists) : null;

    $mid = floor($n / 2);
    $left = $this->mergeKLists(array_slice($lists, 0, $mid));
    $right = $this->mergeKLists(array_slice($lists, $mid));

    return $this->mergeTwoLists($left, $right);
}
