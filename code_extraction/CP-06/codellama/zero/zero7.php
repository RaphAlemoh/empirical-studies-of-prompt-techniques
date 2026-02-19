<?php

function mergeKLists($lists) {
    // If there are no lists, return null
    if (empty($lists)) return null;

    // Merge the first two lists
    $head = $this->mergeTwoLists($lists[0], $lists[1]);

    // Recursively merge the rest of the lists
    for ($i = 2; $i < count($lists); $i++) {
        $head = $this->mergeTwoLists($head, $lists[$i]);
    }

    return $head;
}
