<?php

function mergeKLists(array $lists): ?ListNode {
    if (empty($lists)) {
        return null;
    }
    if (count($lists) === 1) {
        return $lists[0];
    }
    $merged = new ListNode();
    $current = $merged;
    while (!empty($lists)) {
        $first = array_shift($lists);
        while ($first !== null) {
            $current->next = $first;
            $current = $current->next;
            $first = $first->next;
        }
    }
    return $merged->next;
}
