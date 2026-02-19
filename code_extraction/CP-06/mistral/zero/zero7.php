<?php

function mergeKLists(array $lists): ?ListNode {
    if (empty($lists)) {
        return null;
    }

    $comparator = new Comparator();

    foreach ($lists as $list) {
        if (!is_null($list)) {
            $comparator->insert($list);
        }
    }

    $result = $merged = $head = null;

    while (!$comparator->isEmpty()) {
        $current = $comparator->heap[0];
        if (is_null($result)) {
            $result = $head = $current;
        } else {
            $merged->next = $current;
            $merged = $merged->next;
        }
        $comparator->heap = array_filter($comparator->heap, function (ListNode $node) use ($current) {
            return $current->val !== $node->val;
        });
    }

    return $head;
}
