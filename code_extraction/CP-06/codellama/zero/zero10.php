<?php

function mergeKLists(array $lists): ?ListNode {
    // Check if there are any lists to be merged
    if (empty($lists)) {
        return null;
    }

    // Merge two lists at a time until only one list remains
    while (count($lists) > 1) {
        $list1 = array_shift($lists);
        $list2 = array_shift($lists);
        $mergedList = mergeTwoLists($list1, $list2);
        array_unshift($lists, $mergedList);
    }

    // Return the head of the merged list
    return array_shift($lists);
}
