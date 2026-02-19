<?php

function mergeKLists(array $lists): ?ListNode {
    // Base case: If there are no lists to merge, return null.
    if (empty($lists)) {
        return null;
    }

    // Recursive case: Merge the first two lists and then recurse on the merged list.
    $head = $lists[0];
    for ($i = 1; $i < count($lists); $i++) {
        $head = mergeTwoLists($head, $lists[$i]);
    }

    return $head;
}
