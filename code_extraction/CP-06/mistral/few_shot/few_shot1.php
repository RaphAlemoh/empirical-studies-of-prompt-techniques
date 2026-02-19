<?php

function mergeKLists($lists) {
    if (empty($lists)) {
        return null;
    }

    $n = count($lists);

    // Heapify the lists
    for ($i = 0; $i < $n; ++$i) {
        $heap[$i] = $lists[$i];
    }
    for ($i = 0; $i < $n; ++$i) {
        for ($j = $i + 1; $j < $n; ++$j) {
            if ($heap[$i]->val > $heap[$j]->val) {
                [$heap[$i], $heap[$j]] = [$heap[$j], $heap[$i]];
            }
        }
    }

    // Merge the lists using a dummy node and a current pointer
    $dummy = new ListNode(0);
    $current = $dummy;

    while (!empty($heap)) {
        $min_node = array_shift($heap);

        $current->next = $min_node;
        $current = $current->next;

        if ($min_node->next) {
            $heap[] = $min_node->next;
        }
    }

    return $dummy->next;
}
