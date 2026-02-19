<?php

function mergeKLists(array $lists): ?ListNode {
    if (!$lists) return null;

    $minHeap = new SplMinHeap();
    foreach ($lists as $list) {
        if ($list) $minHeap->insert(new stdClass());
    }

    $head = $prev = new ListNode(null);

    while (!$minHeap->isEmpty()) {
        $min = $minHeap->extractMin();
        $curr = $lists[$min];

        $next = $curr;
        while ($next) {
            $minHeap->insert($next);
            $prev->next = new ListNode($next->val, $next->next);
            $prev = $prev->next;
            $next = $next->next;
        }
    }

    return $head->next;
}
