<?php

function mergeKLists(array $lists) {
    // Initialize an empty array to store the merged lists
    $mergedList = [];

    // Loop through each list in the input array
    foreach ($lists as $list) {
        // If the current list is not null, add it to the mergedList array
        if ($list !== null) {
            $mergedList[] = $list;
        }
    }

    // While there are still lists in the mergedList array
    while (count($mergedList) > 0) {
        // Initialize a new array to store the current merge result
        $mergeResult = [];

        // Loop through each pair of lists in the mergedList array
        for ($i = 0; $i < count($mergedList); $i += 2) {
            // If there are more than two lists left, combine them recursively
            if (count($mergedList) > $i + 1) {
                $mergeResult[] = mergeTwoLists($mergedList[$i], $mergedList[$i + 1]);
            } else {
                // If there is only one list left, add it to the merge result
                $mergeResult[] = $mergedList[$i];
            }
        }

        // Replace the merged lists with the new merge result
        $mergedList = $mergeResult;
    }

    // Return the head of the merged list
    return $mergedList[0];
}
