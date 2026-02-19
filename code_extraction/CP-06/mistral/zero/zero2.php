<?php

function mergeKLists($lists) {
    if (empty($lists)) return null;

    $n = count($lists);
    for ($i = 1; $i < $n; $i *= 2) {
        $newLists = [];
        for ($j = 0; $j < $n; $j += $i * 2) {
            $list1 = $lists[$j];
            $list2 = isset($lists[$j + $i]) ? $lists[$j + $i] : null;
            $mergedList = mergeLists($list1, $list2);
            if ($i < $n) {
                $newLists[] = $mergedList;
                $newLists[] = $lists[$j + $i];
            } else {
                $newLists[] = $mergedList;
            }
        }
        $lists = $newLists;
    }

    return $lists[0];
}
