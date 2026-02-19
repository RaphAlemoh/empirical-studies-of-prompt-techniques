<?php

function mergeKLists(array $lists): ?ListNode {
    if (empty($lists)) {
        return null;
    }

    $count = count($lists);

    for ($heapSize = $count; $heapSize > 1; $heapSize = ceil($heapSize / 2)) {
        $heap = new SplMinHeap();

        foreach ($lists as $list) {
            if (!is_null($list)) {
                $heap->insert(compact('list'));
            }
        }

        $dummy = new ListNode(0);
        $current = &$dummy;

        while (!$heap->isEmpty()) {
            list($node) = $heap->extractMin();

            $current->next = $node;
            $current = $current->next;

            if (!is_null($node->next)) {
                $heap->insert(compact('node->next'));
            }
        }

        $lists = [$dummy->next];
    }

    return reset($lists);
}
