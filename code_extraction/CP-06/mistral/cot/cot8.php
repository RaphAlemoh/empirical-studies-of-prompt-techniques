<?php

function mergeKLists($lists) {
    if (empty($lists)) return null;

    $n = count($lists);

    for ($level = 1; $level < $n; $level *= 2) {
        $preLevelTail = array();

        for ($i = 0; $i < $n; $i += 2 * $level) {
            $current = $temp = null;

            for ($j = $i; $j < min($n, $i + $level); $j++) {
                if (!is_null($lists[$j])) {
                    if (is_null($current)) {
                        $current = $lists[$j];
                    } else {
                        $temp->next = $lists[$j];
                        $temp = $lists[$j];
                    }
                }
            }

            $temp->next = $current;
            $preLevelTail[] = $temp;
        }

        $lists = $preLevelTail;
    }

    return array_shift($lists);
}
