<?php

function mergeKLists($lists) {
    // check if input is empty
    if (empty($lists)) {
        return null;
    }
    
    // initialize variables
    $head = null;
    $tail = null;
    $count = count($lists);
    
    // merge lists recursively
    while ($count > 0) {
        $min = null;
        foreach ($lists as $list) {
            if ($list === null) continue;
            if ($min === null || $list->val < $min->val) {
                $min = $list;
            }
        }
        
        // insert node into linked list
        if ($head === null) {
            $head = $tail = $min;
        } else {
            $tail->next = $min;
            $tail = $min;
        }
        
        // remove merged node from input lists
        foreach ($lists as &$list) {
            if ($list === $min) {
                $list = $min->next;
                break;
            }
        }
        
        $count--;
    }
    
    return $head;
}
