<?php

function mergeKLists(array $lists): ?ListNode {
    if (empty($lists)) {
        return null;
    }

    $minHeap = new SplMinHeap();
    foreach ($lists as $list) {
        if (!is_null($list)) {
            $minHeap->insert(new stdClass(), $list);
        }
    }

    $dummy = new ListNode(0);
    $current = $dummy;

    while (!$minHeap->isEmpty()) {
        list($item, $node) = $minHeap->extractMin();
        $current->next = $node;
        $current = $current->next;

        if (!is_null($node->next)) {
            $minHeap->insert(new stdClass(), $node->next);
        }
    }

    return $dummy->next;
}
