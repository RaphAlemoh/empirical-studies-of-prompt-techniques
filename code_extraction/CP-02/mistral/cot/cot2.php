<?php

function isValid(string $s) {
    $stack = [];
    $brackets = [['(', ')'], ['{', '}'], ['[', ']'];

    foreach (str_split($s) as $char) {
        if (!empty($stack) && in_array($char, $brackets[array_search($stack[count($stack) - 1], $brackets) + 1]) {
            array_pop($stack);
        } else {
            $stack[] = $char;
            break 2;
        }
    }

    return empty($stack);
}
