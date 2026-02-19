<?php

function mergeKLists(array $lists): ?ListNode {
    if (empty($lists)) {
        return null;
    }

    // Create a priority queue to store the nodes of the linked lists
    $pq = new SplPriorityQueue();

    // Add the head nodes of each linked list to the priority queue
    foreach ($lists as $list) {
        if ($list !== null) {
            $pq->insert($list, $list->val);
        }
    }

    // Create a new merged linked list and return its head node
    $dummy = new ListNode(0);
    $current = $dummy;

    while (!$pq->isEmpty()) {
        $current->next = $pq->extract();
        $current = $current->next;
        if ($current->next !== null) {
            $pq->insert($current->next, $current->next->val);
        }
    }

    return $dummy->next;
}
