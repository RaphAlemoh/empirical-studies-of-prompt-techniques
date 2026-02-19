<?php

function mergeKLists(array $lists): ?ListNode
{
    if (empty($lists)) return null;
    while (count($lists) > 1) {
        $newList = [];
        for ($i = 0; $i < count($lists); $i += 2) {
            if (!isset($lists[$i + 1])) break;
            $newList[] = mergeTwoLists($lists[$i], $lists[$i + 1]);
        }
        $lists = array_filter($newList, fn ($list) => $list !== null);
    }
    return $lists[0];
}
