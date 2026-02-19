<?php

function mergeKLists(array $lists) {
    // Base case: if there are no lists, return null
    if (empty($lists)) return null;
    
    // Get the length of the input array
    $length = count($lists);
    
    // If the length is 1, return the only list
    if ($length === 1) return $lists[0];
    
    // Divide the lists into two groups of half the length
    $halfLength = (int) floor($length / 2);
    $list1 = array_slice($lists, 0, $halfLength);
    $list2 = array_slice($lists, $halfLength);
    
    // Recursively merge the two groups of lists
    return mergeTwoLists(mergeKLists($list1), mergeKLists($list2));
}
