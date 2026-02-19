<?php

function mergeKLists($lists) {
    if (!count($lists)) return null;

    $n = count($lists);
    for ($i = 1; $i < $n; $i *= 2) {
        $tempLists = [];
        for ($j = 0; $j < $n; $j += $i * 2) {
            $first = $lists[$j];
            if ($j + $i < $n) {
                $second = $lists[$j + $i];
                $tempLists[] = mergeTwoLists($first, $second);
            } else {
                $tempLists[] = $first;
            }
        }
        $lists = $tempLists;
    }
    return $lists[0];
}
