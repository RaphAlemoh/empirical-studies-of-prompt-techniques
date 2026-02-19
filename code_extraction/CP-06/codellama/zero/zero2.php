<?php

function mergeKLists(array $lists) {
    if (count($lists) === 0) {
        return null;
    }
    // Merge two lists together and return the head of the merged list
    function mergeTwoLists($list1, $list2) {
        $dummyHead = new ListNode(null);
        $cur = $dummyHead;
        while ($list1 && $list2) {
            if ($list1->val <= $list2->val) {
                $cur->next = $list1;
                $list1 = $list1->next;
            } else {
                $cur->next = $list2;
                $list2 = $list2->next;
            }
            $cur = $cur->next;
        }
        // Add any remaining nodes from the non-empty list
        if ($list1) {
            $cur->next = $list1;
        }
        if ($list2) {
            $cur->next = $list2;
        }
        return $dummyHead->next;
    }
    
    // Merge k lists together and return the head of the merged list
    function mergeKLists($lists) {
        if (count($lists) === 1) {
            return $lists[0];
        }
        $mid = count($lists) / 2;
        $left = array_slice($lists, 0, $mid);
        $right = array_slice($lists, $mid);
        return mergeTwoLists(mergeKLists($left), mergeKLists($right));
    }
    
    return mergeKLists($lists);
}
