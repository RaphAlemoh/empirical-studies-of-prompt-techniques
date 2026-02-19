<?php

function mergeKLists($lists) {
    // Base case: if there are no lists, return null
    if (count($lists) === 0) {
        return null;
    }

    // Recursive case: if there is only one list, return it
    if (count($lists) === 1) {
        return $lists[0];
    }

    // Divide the lists into two halves
    $mid = count($lists) / 2;
    $leftLists = array_slice($lists, 0, $mid);
    $rightLists = array_slice($lists, $mid);

    // Recursively merge the left and right lists
    $leftMergedList = mergeKLists($leftLists);
    $rightMergedList = mergeKLists($rightLists);

    // Merge the left and right lists
    return mergeTwoLists($leftMergedList, $rightMergedList);
}
