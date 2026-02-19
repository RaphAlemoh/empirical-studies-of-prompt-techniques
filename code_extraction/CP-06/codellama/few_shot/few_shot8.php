<?php

function mergeKLists(array $lists): ?ListNode {
    if (count($lists) == 0) {
        return null;
    } elseif (count($lists) == 1) {
        return $lists[0];
    }
    
    // Divide the lists into two halves
    $mid = count($lists) / 2;
    $left = array_slice($lists, 0, $mid);
    $right = array_slice($lists, $mid);
    
    // Recursively merge the two halves
    return mergeTwoLists(mergeKLists($left), mergeKLists($right));
}
