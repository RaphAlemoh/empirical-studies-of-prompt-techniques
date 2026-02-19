<?php

function mergeKLists(array $lists): ?ListNode {
    if (!count($lists)) {
        return null;
    }

    $minHeap = new SplMinHeap();

    foreach ($lists as $list) {
        if ($list !== null) {
            $minHeap[] = $list;
        }
    }

    $mergedList = null;
    while ($minHeap->count() > 1) {
        $node1 = array_shift($minHeap);
        $node2 = array_shift($minHeap);

        if (!$mergedList) {
            $mergedList = new ListNode($node1->val < $node2->val ? $node1->val : $node2->val);
            $current = $mergedList;
        } else {
            $current->next = new ListNode($node1->val < $node2->val ? $node1->val : $node2->val);
            $current = $current->next;
        }

        if ($node1->next) {
            $minHeap[] = $node1->next;
        }
        if ($node2->next) {
            $minHeap[] = $node2->next;
        }
    }

    while ($minHeap->count() > 0) {
        $lastNode = array_pop($minHeap);
        $current->next = $lastNode;
        $current = $current->next;
    }

    return $mergedList;
}
