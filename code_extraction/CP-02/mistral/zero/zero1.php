<?php

function isValid(string $s) {
    $stack = [];
    $valid_brackets = ['{', '[', '('];
    $closers = ['}', ']', ')'];

    for ($i = 0; $i < strlen($s); $i++) {
        if (in_array($s[$i], $valid_brackets)) {
            array_push($stack, $s[$i]);
        } elseif (!empty($stack) && strpos($closers, $s[$i]) === strpos($closers, array_pop($stack)) + 1) {
            // If the stack is not empty and the closing bracket matches the top of the stack
        } else {
            return false;
        }
    }

    return empty($stack);
}
