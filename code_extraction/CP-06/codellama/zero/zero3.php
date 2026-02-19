<?php

function mergeKLists(array $lists): ?ListNode
{
    if (empty($lists)) return null;
    // Merge the first two lists
    $mergedList = $this->mergeTwoLists($lists[0], $lists[1]);
    // Recursively merge the remaining lists with the merged list
    for ($i = 2; $i < count($lists); $i++) {
        $mergedList = $this->mergeTwoLists($mergedList, $lists[$i]);
    }
    return $mergedList;
}
