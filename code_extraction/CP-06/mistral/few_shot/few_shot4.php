<?php

function mergeKLists($lists) {
    $count = count($lists);

    if ($count === 0) return null;

    for ($i = 1; $i < $count; $i *= 2) {
        $tempLists = [];

        for ($j = 0; $j < $count; $j += $i * 2) {
            $list1 = $lists[$j];
            $list2 = null;

            if (isset($lists[$j + $i])) {
                $list2 = $lists[$j + $i];
            }

            $lists[$j] = mergeTwoLists($list1, $list2);
        }

        foreach ($tempLists as $list) {
            $lists[] = $list;
        }
    }

    return $lists[0];
}
