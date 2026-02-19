<?php

function mergeKLists(array $lists): ?ListNode {
    if (empty($lists)) {
        return null;
    }

    for ($i = 1; $i < count($lists); ++$i) {
        $lists[$i] = mergeLists($lists[0], $lists[$i]);
    }

    if (count($lists) > 1) {
        return mergeKLists([$lists[0], ...$lists]);
    }

    return $lists[0];
}
