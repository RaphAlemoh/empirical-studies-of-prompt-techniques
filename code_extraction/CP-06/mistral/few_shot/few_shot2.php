<?php

function mergeKLists(array $lists): ?ListNode {
    if (empty($lists)) {
        return null;
    }

    return $head = mergeSort($lists, 0, count($lists) - 1)[0];
}
