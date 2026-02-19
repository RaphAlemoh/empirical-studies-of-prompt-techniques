<?php

function mergeKLists($lists) {
    if (count($lists) == 0) return null;
    if (count($lists) == 1) return $lists[0];
    $mid = count($lists) / 2;
    $left = array_slice($lists, 0, $mid);
    $right = array_slice($lists, $mid);
    $leftHead = mergeKLists($left);
    $rightHead = mergeKLists($right);
    return mergeTwoLists($leftHead, $rightHead);
}
