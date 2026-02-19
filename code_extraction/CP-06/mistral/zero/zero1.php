<?php

function mergeKLists($lists) {
    if (empty($lists)) return null;

    $n = count($lists);

    function mergeTwoLists(ListNode $list1, ListNode $list2) {
        $merged = new ListNode();
        $head = &$merged;

        while (!is_null($list1) && !is_null($list2)) {
            if ($list1->val <= $list2->val) {
                $next = $list1;
                $list1 = $list1->next;
            } else {
                $next = $list2;
                $list2 = $list2->next;
            }
            $head->next = $next;
            $head = $next;
        }

        if (!is_null($list1)) {
            $head->next = $list1;
        }

        if (!is_null($list2)) {
            $head->next = $list2;
        }

        return $merged->next;
    }

    $mid = floor($n / 2);

    for ($i = 0; $i < $mid; ++$i) {
        $lists[$i] = mergeTwoLists($lists[$i], $lists[$i + $mid]);
    }

    if ($n % 2 == 1) {
        array_pop($lists);
    }

    if (count($lists) === 1) return reset($lists);

    return mergeTwoLists(reset($lists), next($lists));
}
