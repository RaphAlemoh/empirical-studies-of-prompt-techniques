<?php

function mergeKLists(array $lists): ?ListNode {
    if (count($lists) == 0) return null;
    elseif (count($lists) == 1) return $lists[0];
    else {
        $mid = count($lists)/2;
        $left = array_slice($lists, 0, $mid);
        $right = array_slice($lists, $mid+1, count($lists));
        $lhead = mergeKLists($left);
        $rhead = mergeKLists($right);
        return mergeTwoLists($lhead, $rhead);
    }
}
