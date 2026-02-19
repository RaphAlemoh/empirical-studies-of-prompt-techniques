<?php

function mergeKLists(array $lists): ?ListNode {
    if (empty($lists)) {
        return null;
    }

    $n = count($lists);
    for ($i = floor($n / 2); $i > 0; $i -= 1) {
        for ($j = 0; $j < $i; $j += $n / $i) {
            $lists[j]   = mergeLists($lists[j],   $lists[$j + $n / $i]);
            $lists[$j + intval(($n + $i - 1) / $i)] = mergeLists($lists[$j + intval(($n + $i - 1) / $i)], $lists[$j + 1 + intval(($n + $i - 1) / $i)]);
        }
    }

    return $lists[0];
}
