<?php

function isValid($s) {
    $stack = [];
    $openers = ['{', '[', '('];
    $closers = [']', '}', ')' ];

    foreach (str_split($s) as $char) {
        if (in_array($char, $openers)) {
            array_push($stack, $char);
        } elseif ($char === array_pop($stack) && !$stack) {
            // If there's no stack, the opening bracket doesn't have a corresponding closing one.
            return false;
        } else {
            // If the popped element from the stack is not equal to $char, there's an invalid pairing.
            return false;
        }
    }

    // If there are still elements in the stack after iterating through $s, it means that some closing brackets were missed or paired incorrectly.
    return empty($stack);
}
