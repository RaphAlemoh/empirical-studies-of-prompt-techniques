<?php

function mergeKLists(array $lists): ?ListNode {
    if (empty($lists)) return null;

    // Merge two lists at a time until only one list remains
    while (count($lists) > 1) {
        for ($i = 0; $i < count($lists) - 1; $i += 2) {
            $lists[$i] = mergeTwoLists($lists[$i], $lists[$i + 1]);
        }

        // If there are an odd number of lists, merge the last one with null
        if (count($lists) % 2 !== 0) {
            $lists[count($lists) - 1] = mergeTwoLists($lists[count($lists) - 1], null);
        }
    }

    return $lists[0];
}
