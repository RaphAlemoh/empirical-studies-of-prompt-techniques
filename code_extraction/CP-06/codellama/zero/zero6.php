<?php

function mergeKLists(array $lists): ?ListNode {
    // Create an empty array to store the merged lists
    $mergedLists = [];

    // Loop through each list in the input and add it to the mergedLists array
    foreach ($lists as $list) {
        if ($list !== null) {
            $mergedLists[] = $list;
        }
    }

    // While there are still lists left to merge
    while (count($mergedLists) > 1) {
        // Initialize two variables to keep track of the current and next list to merge
        $currentList = array_shift($mergedLists);
        $nextList = array_shift($mergedLists);

        // Merge the two lists and add the result to the mergedLists array
        $mergedLists[] = mergeTwoLists($currentList, $nextList);
    }

    return array_pop($mergedLists);
}
