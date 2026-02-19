<?php

function mergeKLists(array $lists): ?ListNode {
    // Optimal merging strategy:
    // Start by merging the first two lists, then iteratively merge the resulting list with the next list.
    // This process continues until only one list is left, which will be the final merged list.

    while (count($lists) > 1) {
        $list1 = array_shift($lists);
        $list2 = array_shift($lists);

        if ($list1 === null || $list2 === null) {
            break;
        }

        // Merge the two lists and add the result to the beginning of the $lists array.
        $mergedList = mergeTwoLists($list1, $list2);
        array_unshift($lists, $mergedList);
    }

    return array_pop($lists);
}
