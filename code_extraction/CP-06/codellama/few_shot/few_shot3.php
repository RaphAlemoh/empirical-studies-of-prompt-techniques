<?php

function mergeKLists(array $lists): ?ListNode {
    if (count($lists) === 0) {
        return null;
    }
    if (count($lists) === 1) {
        return $lists[0];
    }
    
    // Divide the input arrays into two halves.
    $mid = count($lists) / 2;
    $leftLists = array_slice($lists, 0, $mid);
    $rightLists = array_slice($lists, $mid);
    
    // Recursively merge the left and right halves.
    return mergeTwoLists(mergeKLists($leftLists), mergeKLists($rightLists));
}
