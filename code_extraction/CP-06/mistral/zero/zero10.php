<?php

function mergeKLists(array $lists): ?ListNode {
    if (empty($lists)) {
        return null;
    }

    for ($i = floor(count($lists) / 2); $i > 0; $i--) {
        for ($j = 0; $j < $i; $j += 2) {
            $lists[$j] = mergeLists($lists[$j], $lists[$j + 1] ?? null);
        }
    }

    return $lists[0];
}
