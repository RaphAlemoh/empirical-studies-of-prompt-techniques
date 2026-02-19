<?php

function isValid($s) {
    if (empty($s)) return true;

    $stack = [];
    $openers = ['(', '[', '{'];
    $closers = [')', ']', '}'];

    for ($i = 0; $i < strlen($s); $i++) {
        $char = $s[$i];
        if (in_array($char, $openers)) {
            array_push($stack, $char);
        } elseif (in_array($char, $closers)) {
            if (!empty($stack) && $closers[array_key_last($stack)] === $char && $char !== array_pop($stack)) {
                return false;
            }
        }
    }

    // Check if there are any openers left in the stack
    return empty($stack);
}
