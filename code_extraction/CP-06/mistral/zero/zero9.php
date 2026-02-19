<?php

function mergeKLists(array $lists): ?ListNode {
    if (empty($lists)) return null;

    $minHeap = construct(function ($a, $b) {
        return $a->val - $b->val;
    });

    foreach ($lists as $list) {
        if (!is_null($list)) {
            $minHeap->insert($list);
        }
    }

    $head = null;
    $prevNode = null;

    while (!$minHeap->isEmpty()) {
        /** @var ListNode $current */
        $current = $minHeap->extract();
        $node = new ListNode($current->val);

        if (is_null($head)) {
            $head = $node;
        } else {
            $prevNode->next = $node;
        }

        $prevNode = $node;
    }

    return $head;
}
