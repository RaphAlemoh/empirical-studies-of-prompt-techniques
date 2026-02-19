<?php

function mergeKLists(array $lists): ?ListNode {
    // Optimal merging strategy: Merge two lists at a time,
    // until only one list remains. This ensures that the
    // final merged list is sorted and efficient in terms of
    // time complexity (O(N log k)).
    
    // Base case: If there are no lists to merge, return null.
    if (count($lists) === 0) {
        return null;
    }
    
    // Merge two lists at a time until only one list remains.
    while (count($lists) > 1) {
        $list1 = array_shift($lists);
        $list2 = array_shift($lists);
        
        $mergedList = mergeTwoLists($list1, $list2);
        
        // Add the merged list to the list of lists.
        $lists[] = $mergedList;
    }
    
    return array_pop($lists);
}
