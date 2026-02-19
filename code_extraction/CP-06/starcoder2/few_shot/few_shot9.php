<?php

function mergeKLists(array $lists): ?ListNode {
    if (empty($lists)) return null;

    $dummy = new ListNode();
    $current = $dummy;

    while (!empty($lists)) {
        $minValue = PHP_INT_MAX;

        foreach ($lists as  $key => &$list)
            if (!$list || $list->val < $minValue)
                list($lists[$key], $minValue, $current) = [
                    $list, $list ? $list->val : PHP_INT_MAX, $current
                ];
        $current->next = $list;
    }

    return $dummy->next;
}
