<?php

function mergeKLists(array $lists): ?ListNode {
    // Initialize the head of the merged list to be the first element in the lists array
    $head = $lists[0];
    // Initialize the current pointer to be the head of the merged list
    $current = $head;
    // Loop through each list in the lists array
    for ($i = 1; $i < count($lists); $i++) {
        // Merge the current list with the next list in the lists array
        $current = mergeTwoLists($current, $lists[$i]);
    }
    return $head;
}
