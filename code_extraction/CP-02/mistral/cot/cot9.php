<?php

function isValid($s) {
    $stack = [];
    $openers = ['(', '[', '{'];
    $closers = [')', ']', '}'];

    foreach (str_split($s) as $char) {
        if (in_array($char, $openers)) {
            array_push($stack, $char);
        } elseif ($char === str_replace($openers, '$0', $stack[count($stack) - 1]) && count($stack) > 0) {
            array_pop($stack);
        } else {
            return false;
        }
    }

    return empty($stack);
}
