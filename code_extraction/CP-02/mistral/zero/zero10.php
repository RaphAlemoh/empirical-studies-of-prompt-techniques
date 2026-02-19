<?php

function isValid($s) {
    $stack = [];
    $pairs = [
        '(' => ')',
        '{' => '}',
        '[' => ']'
    ];

    foreach (str_split($s) as $char) {
        if (!empty($stack) && array_search($char, $pairs) === $stack[count($stack)-1]) {
            array_pop($stack);
        } else {
            if ($char === '(' || $char === '{' || $char === '[') {
                $stack[] = $char;
            } else {
                if (empty($stack) || !array_search($char, $pairs)) {
                    return false;
                }
            }
        }
    }

    return empty($stack);
}
```

This solution uses a stack data structure to keep track of the open brackets. It iterates through each character in the input string and performs checks based on the validity rules you provided. If the string is valid, it returns `true`. Otherwise, it returns `false`. The time complexity of this solution is O(n) as required.
