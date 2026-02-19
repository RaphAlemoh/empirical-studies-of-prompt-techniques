<?php

function isValid($s) {
    $stack = [];
    $pairings = [
        '(' => ',)',
        '[' => ']',
        '{' => '}'
    ];

    foreach (str_split($s) as $char) {
        if (in_array($char, array_keys($pairings))) {
            $stack[] = $char;
        } elseif ($stack && $stack[count($stack) - 1] === $pairings[$char]) {
            array_pop($stack);
        } else {
            return false;
        }
    }

    return empty($stack);
}
