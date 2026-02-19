<?php

function mergeKLists(array $lists) {
    if (empty($lists)) {
        return null;
    }

    $n = count($lists);

    for ($i = floor($n / 2); $i > 0; $i -= floor($n / 2)) {
        for ($j = 0; $j < $i; $j += $n) {
            $lists[$j]   = mergeLists($lists[$j], $lists[$j + $n]);
        }

        $n = $n / 2;
    }

    return $lists[0];
}
