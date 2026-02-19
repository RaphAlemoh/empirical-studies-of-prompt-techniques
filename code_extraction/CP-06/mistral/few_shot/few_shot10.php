<?php

function mergeKLists(array $lists): ?ListNode {
    if (empty($lists)) return null;

    $minHeap = new SplMinHeap();
    foreach ($lists as $list) {
        if (!is_null($list)) {
            $minHeap[] = $list;
        }
    }

    $dummy = new ListNode(0);
    $current = $dummy;

    while ($minHeap) {
        $node = array_shift($minHeap);
        $current->next = $node;
        $current = $current->next;

        if (!is_null($node->next)) {
            $minHeap[] = $node->next;
        }
    }

    return $dummy->next;
}
