<?php

function mergeKLists(array $lists): ?ListNode {
    if (empty($lists)) {
        return null;
    }

    for ($i = 1; $i < count($lists); ++$i) {
        $lists[$i] = merge($lists[0], $lists[$i]);
    }

    $middle = floor(count($lists) / 2);

    for ($x = 0; $middle > 0; --$middle) {
        $lists[$x] = merge($lists[$x], $lists[$x + $middle]);
    }

    if ($middle !== floor(count($lists))) {
        $lists[floor($middle)] = merge($lists[floor($middle)], $lists[count($lists) - 1]);
    }

    return $lists[0];
}
