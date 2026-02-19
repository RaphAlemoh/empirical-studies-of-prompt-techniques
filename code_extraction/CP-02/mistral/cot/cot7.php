<?php

function isValid($s) {
    $stack = [];
    $opening_brackets = ['(', '[', '{'];
    $closing_brackets = [')', ']', '}'];
    $pairings = zip($opening_brackets, $closing_brackets);

    foreach (str_split($s) as $char) {
        if (!in_array($char, $opening_brackets)) {
            if ($stack && array_pop($stack) !== $char) {
                return false;
            }
        } else {
            if (!$stack || $char !== current($pairings[$stack[count($stack)-1]]) ) {
                $stack[] = $char;
            }
        }
    }

    return !$stack;
}
