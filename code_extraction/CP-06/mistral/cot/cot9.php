<?php

function mergeKLists(array $lists): ?ListNode {
    if (empty($lists)) return null;

    $minHeap = new SplMinHeap();
    foreach ($lists as $list) {
        if (!is_null($list)) $minHeap->insert([$list, 0]); // key is the list and value is index in the list
    }

    $head = null;
    $current = &$head;
    while (!$minHeap->isEmpty()) {
        list($node, $index) = $minHeap->extractMin();
        if (!is_null($node)) {
            $current->next = $node;
            $current = $current->next;
            $index++;
            if ($index < count($lists[$node])) $minHeap->insert([$node, $index]);
        }
    }

    return $head;
}
