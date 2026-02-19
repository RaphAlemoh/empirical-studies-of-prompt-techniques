<?php

function mergeKLists(array $lists): ?ListNode {
    if (empty($lists)) {
        return null;
    }

    $minHeap = new SplMinHeap();

    foreach ($lists as $list) {
        if (!is_null($list)) {
            $minHeap[] = $list;
        }
    }

    $head = null;
    $tail = null;

    while (!$minHeap->isEmpty()) {
        $node = array_shift($minHeap);

        if (is_null($head)) {
            $head = $node;
            $tail = $node;
        } else {
            $tail->next = $node;
            $tail = $tail->next;
        }

        $node = $node->next;
        if (!is_null($node)) {
            $minHeap[] = $node;
        }
    }

    return $head;
}
