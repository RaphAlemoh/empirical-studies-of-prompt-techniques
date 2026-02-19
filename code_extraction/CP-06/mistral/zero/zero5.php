<?php

function mergeKLists(array $lists): ?ListNode {
    if (empty($lists)) {
        return null;
    }

    $pq = new SplMinHeap();

    foreach ($lists as $list) {
        if (!is_null($list)) {
            $pq[] = $list;
        }
    }

    $head = $temp = new ListNode(0);

    while (count($pq) > 0) {
        $min = $pq[0];
        $pq->extractMin();
        $temp->next = $min;
        $temp = $temp->next;

        if (!is_null($min->next)) {
            $pq[] = $min->next;
        }
    }

    return $head->next;
}
