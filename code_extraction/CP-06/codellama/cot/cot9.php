<?php

function mergeKLists($lists) {
    // Calculate the total number of nodes in all lists
    $totalNodes = 0;
    foreach ($lists as $list) {
        $totalNodes += count($list);
    }
    
    // Create an array to store the merged list
    $mergedList = array();
    
    // Loop through each list and merge it with the rest of the lists
    for ($i = 0; $i < count($lists); $i++) {
        $currentList = $lists[$i];
        while (!empty($currentList)) {
            $mergedList[] = array_shift($currentList);
            if (!empty($currentList)) {
                $currentList = mergeTwoLists($currentList, $lists[++$i]);
            } else {
                $i++;
            }
        }
    }
    
    // Return the head of the merged list
    return array_shift($mergedList);
}
