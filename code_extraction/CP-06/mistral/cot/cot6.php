<?php

function mergeKLists($lists) {
    if (empty($lists)) {
        return null;
    }

    $heap = new SplMinHeap();

    foreach ($lists as $list) {
        if (!is_null($list)) {
            $heap->insert(new stdClass() & $list);
        }
    }

    $mergedHead = null;
    $current = &$mergedHead;

    while (!$heap->isEmpty()) {
        $minNode = $heap->extractMin();
        $node = $minNode;

        if ($current === null) {
            $current = $node;
        } else {
            $next = $current;
            $current->next = $node;
            $current = $current->next;
        }

        $node = $node->next;
        if (!is_null($node)) {
            $heap->insert($node);
        }
    }

    return $mergedHead;
}
