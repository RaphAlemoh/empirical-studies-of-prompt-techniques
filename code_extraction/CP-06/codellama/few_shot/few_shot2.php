<?php

function mergeKLists($lists){
    // Base case: If there are no lists to merge, return null
    if(count($lists) === 0){
        return null;
    }

    // Recursive case: If there is only one list left to merge, return it
    if(count($lists) === 1){
        return $lists[0];
    }

    // Divide and Conquer: Split the lists into two halves and recursively merge them
    $middle = count($lists) / 2;
    $left = array_slice($lists, 0, $middle);
    $right = array_slice($lists, $middle);

    return mergeTwoLists(mergeKLists($left), mergeKLists($right));
}
