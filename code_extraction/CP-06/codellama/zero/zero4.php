<?php

function mergeKLists(array $lists) {
    if (empty($lists)) return null;
    // Combine all lists into one array
    $allNodes = [];
    foreach ($lists as $list) {
        while ($list) {
            $allNodes[] = $list->val;
            $list = $list->next;
        }
    }
    // Sort the array
    sort($allNodes);
    // Create a new linked list from the sorted array
    $head = new ListNode(array_shift($allNodes));
    $tail = $head;
    while (!empty($allNodes)) {
        $tail->next = new ListNode(array_shift($allNodes));
        $tail = $tail->next;
    }
    return $head;
}
