<?php

function isValid($s) {
    $openers = ['(', '[', '{'];
    $closers = [')', ']', '}'];
    $stack = [];

    for ($i = 0; $i < strlen($s); $i++) {
        if (in_array($s[$i], $openers)) {
            array_push($stack, $s[$i]);
        } elseif (in_array($s[$i], $closers)) {
            if (!empty($stack)) {
                $last = array_pop($stack);
                if ($closers[$i] != str_replace($openers, $closers, $last)) {
                    return false;
                }
            } else {
                return false;
            }
        }
    }

    // If the stack is empty after checking the entire string, it means all brackets are matched correctly.
    return empty($stack);
}
