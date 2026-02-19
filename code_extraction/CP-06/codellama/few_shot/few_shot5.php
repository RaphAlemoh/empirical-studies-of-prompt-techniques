<?php

function mergeKLists(array $lists): ?ListNode {
    $mergedList = null;
    
    foreach ($lists as $list) {
        if (!$list) continue;
        
        // Iterate through each node in the current list and add it to the mergedList
        for ($node = $list; $node; $node = $node->next) {
            // Add the node to the end of the mergedList, keeping it sorted
            if (!$mergedList || $mergedList->val > $node->val) {
                $mergedList = new ListNode($node->val);
                $current = $mergedList;
            } else {
                while ($current->next && $current->next->val < $node->val) {
                    $current = $current->next;
                }
                $current->next = new ListNode($node->val);
                $current = $current->next;
            }
        }
    }
    
    return $mergedList;
}
